<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use Exception;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Exception\ClientException;
use FactorioItemBrowser\Api\Client\Exception\ConnectionException;
use FactorioItemBrowser\Api\Client\Exception\ErrorResponseExceptionFactory;
use FactorioItemBrowser\Api\Client\Exception\InvalidResponseException;
use FactorioItemBrowser\Api\Client\Exception\UnhandledRequestException;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Common\Constant\Defaults;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * The actual client class sending the request to the server and parsing the response.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Client implements ClientInterface
{
    private GuzzleClientInterface $guzzleClient;
    private SerializerInterface $serializer;

    /** @var array<string, EndpointInterface<AbstractRequest, object>> */
    private array $endpoints = [];

    private string $defaultCombinationId = Defaults::COMBINATION_ID;
    private string $defaultLocale = Defaults::LOCALE;

    /**
     * @param GuzzleClientInterface $guzzleClient
     * @param SerializerInterface $serializer
     * @param array<EndpointInterface<AbstractRequest, object>> $endpoints
     */
    public function __construct(GuzzleClientInterface $guzzleClient, SerializerInterface $serializer, array $endpoints)
    {
        $this->guzzleClient = $guzzleClient;
        $this->serializer = $serializer;

        foreach ($endpoints as $endpoint) {
            $this->endpoints[$endpoint->getHandledRequestClass()] = $endpoint;
        }
    }

    public function setDefaults(string $combinationId, string $locale): void
    {
        $this->defaultCombinationId = $combinationId;
        $this->defaultLocale = $locale;
    }

    public function sendRequest(AbstractRequest $request): PromiseInterface
    {
        $endpoint = $this->endpoints[get_class($request)] ?? null;
        if ($endpoint === null) {
            throw new UnhandledRequestException(get_class($request));
        }

        $clientRequest = $this->createClientRequest($endpoint, $request);
        return $this->guzzleClient->sendAsync($clientRequest)->then(
            function (ResponseInterface $clientResponse) use ($endpoint, $clientRequest) {
                return $this->handleClientResponse($endpoint, $clientRequest, $clientResponse);
            },
            function (TransferException $e): void {
                $this->handleException($e);
            },
        );
    }

    /**
     * @param EndpointInterface<AbstractRequest, object> $endpoint
     * @param AbstractRequest $request
     * @return PsrRequestInterface
     */
    private function createClientRequest(EndpointInterface $endpoint, AbstractRequest $request): RequestInterface
    {
        if ($request->combinationId === '') {
            $request->combinationId = $this->defaultCombinationId;
        }
        if ($request->locale === '') {
            $request->locale = $this->defaultLocale;
        }

        $requestBody = $this->serializer->serialize($request, 'json');
        $headers = [
            'Accept' => 'application/json',
            'Accept-Language' => $request->locale,
            'Content-Type' => 'application/json',
        ];

        return new Request('POST', $endpoint->getRequestPath($request), $headers, $requestBody);
    }

    /**
     * @param EndpointInterface<AbstractRequest, object> $endpoint
     * @param PsrRequestInterface $clientRequest
     * @param PsrResponseInterface $clientResponse
     * @return object
     * @throws InvalidResponseException
     */
    private function handleClientResponse(
        EndpointInterface $endpoint,
        RequestInterface $clientRequest,
        ResponseInterface $clientResponse
    ): object {
        try {
            return $this->serializer->deserialize(
                $clientResponse->getBody()->getContents(),
                $endpoint->getResponseClass(),
                'json',
            );
        } catch (Exception $e) {
            throw new InvalidResponseException(
                $e->getMessage(),
                $clientRequest->getBody()->getContents(),
                $clientResponse->getBody()->getContents(),
                $e,
            );
        }
    }

    /**
     * @param TransferException $exception
     * @throws ClientException
     */
    private function handleException(TransferException $exception): void
    {
        if ($exception instanceof ConnectException) {
            throw new ConnectionException(
                $exception->getMessage(),
                $exception->getRequest()->getBody()->getContents(),
                $exception,
            );
        }

        $requestContent = '';
        $responseContent = '';
        $exceptionMessage = $exception->getMessage();
        if ($exception instanceof RequestException) {
            $requestContent = $exception->getRequest()->getBody()->getContents();

            $response = $exception->getResponse();
            if ($response !== null) {
                $responseContent = $response->getBody()->getContents();
                $exceptionMessage = $this->extractErrorMessage($responseContent, $exception);
            }
        }

        throw ErrorResponseExceptionFactory::create(
            $exception->getCode(),
            $exceptionMessage,
            $requestContent,
            $responseContent,
            $exception,
        );
    }

    private function extractErrorMessage(string $responseContent, Exception $exception): string
    {
        try {
            $data = json_decode($responseContent, true, 512, JSON_THROW_ON_ERROR);
            return $data['error']['message'] ?? $exception->getMessage();
        } catch (Exception $e) {
            return $exception->getMessage();
        }
    }
}
