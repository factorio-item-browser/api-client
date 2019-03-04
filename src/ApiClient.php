<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use Exception;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\ConnectionException;
use FactorioItemBrowser\Api\Client\Exception\ExceptionFactory;
use FactorioItemBrowser\Api\Client\Exception\InvalidResponseException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowser\Api\Client\Response\ErrorResponse;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * The API client class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ApiClient
{
    /**
     * The endpoint service.
     * @var EndpointService
     */
    protected $endpointService;

    /**
     * The Guzzle client.
     * @var ClientInterface
     */
    protected $guzzleClient;

    /**
     * The options.
     * @var Options
     */
    protected $options;

    /**
     * The serializer for thr requests and responses.
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * The currently pending requests.
     * @var array|PromiseInterface[]
     */
    protected $pendingRequests = [];

    /**
     * ApiClient constructor.
     * @param EndpointService $endpointService
     * @param ClientInterface $guzzleClient
     * @param Options $options
     * @param SerializerInterface $serializer
     */
    public function __construct(
        EndpointService $endpointService,
        ClientInterface $guzzleClient,
        Options $options,
        SerializerInterface $serializer
    ) {
        $this->endpointService = $endpointService;
        $this->guzzleClient = $guzzleClient;
        $this->options = $options;
        $this->serializer = $serializer;
    }

    /**
     * Sends the request to the API server. This method is non-blocking and will not wait for the request to actually
     * finish.
     * @param RequestInterface $request
     * @throws ApiClientException
     */
    public function sendRequest(RequestInterface $request): void
    {
        $clientRequest = $this->createClientRequest($request);
        $promise = $this->executeRequest($request, $clientRequest);
        $this->pendingRequests[$this->getRequestId($request)] = $promise;
    }

    /**
     * Creates the request actually send through the HTTP client.
     * @param RequestInterface $request
     * @return PsrRequestInterface
     * @throws ApiClientException
     */
    protected function createClientRequest(RequestInterface $request): PsrRequestInterface
    {
        $endpoint = $this->endpointService->getEndpointForRequest($request);

        return new Request(
            'POST',
            $endpoint->getRequestPath(),
            $this->getRequestHeaders($endpoint),
            $this->serializer->serialize($request, 'json')
        );
    }

    /**
     * Returns the request headers to use for the endpoint.
     * @param EndpointInterface $endpoint
     * @return array|string[]
     * @throws ApiClientException
     */
    protected function getRequestHeaders(EndpointInterface $endpoint): array
    {
        $result = [
            'Accept' => 'application/json',
            'Accept-Language' => $this->options->getLocale(),
            'Content-Type' => 'application/json',
        ];
        if ($endpoint->requiresAuthorizationToken()) {
            $result['Authorization'] = 'Bearer ' . $this->requestAuthorizationToken();
        }
        return $result;
    }

    /**
     * Requests the authorization token if it is not already available.
     * @return string
     * @throws ApiClientException
     */
    protected function requestAuthorizationToken(): string
    {
        if ($this->options->getAuthorizationToken() === '') {
            $authRequest = new AuthRequest();
            $authRequest->setAgent($this->options->getAgent())
                        ->setAccessKey($this->options->getAccessKey())
                        ->setEnabledModNames($this->options->getEnabledModNames());

            $authResponse = $this->fetchResponse($authRequest);
            if ($authResponse instanceof AuthResponse) {
                $this->options->setAuthorizationToken($authResponse->getAuthorizationToken());
            }
        }
        return $this->options->getAuthorizationToken();
    }

    /**
     * Actually executes the request, sending it to the server.
     * @param RequestInterface $request
     * @param PsrRequestInterface $clientRequest
     * @return PromiseInterface
     */
    protected function executeRequest(RequestInterface $request, PsrRequestInterface $clientRequest): PromiseInterface
    {
        $promise = $this->guzzleClient->sendAsync($clientRequest);
        $promise = $promise->then(
            function (PsrResponseInterface $response) use ($request): ResponseInterface {
                return $this->processResponse($request, $response);
            },
            function (RequestException $exception): void {
                $this->processException($exception);
            }
        );
        $promise = $promise->then(
            null,
            function (ApiClientException $exception) use ($request): ResponseInterface {
                if (!$exception instanceof UnauthorizedException) {
                    throw $exception;
                }

                $this->options->setAuthorizationToken('');
                var_dump($request);
                // @todo Handle re-sending the request
            }
        );

        return $promise;
    }

    /**
     * Processes the response received from the HTTP client.
     * @param RequestInterface $request
     * @param PsrResponseInterface $response
     * @return ResponseInterface
     * @throws ApiClientException
     */
    protected function processResponse(RequestInterface $request, PsrResponseInterface $response): ResponseInterface
    {
        $endpoint = $this->endpointService->getEndpointForRequest($request);
        $responseContents = $response->getBody()->getContents();

        try {
            $result = $this->serializer->deserialize($responseContents, $endpoint->getResponseClass(), 'json');
        } catch (Exception $e) {
            throw new InvalidResponseException($e->getMessage(), '', '', $e);
        }

        return $result;
    }

    /**
     * Processes the exception thrown by the HTTP client.
     * @param RequestException $exception
     * @throws ApiClientException
     */
    protected function processException(RequestException $exception): void
    {
        $request = $exception->getRequest()->getBody()->getContents();
        if ($exception instanceof ConnectException) {
            throw new ConnectionException($exception->getMessage(), $request, $exception);
        } else {
            $statusCode = 0;
            $response = '';
            $message = $exception->getMessage();
            if ($exception->getResponse() instanceof PsrResponseInterface) {
                $statusCode = $exception->getResponse()->getStatusCode();
                $response = $exception->getResponse()->getBody()->getContents();

                try {
                    $errorResponse = $this->serializer->deserialize($response, ErrorResponse::class, 'json');
                    if ($errorResponse instanceof ErrorResponse) {
                        $message = $errorResponse->getError()->getMessage();
                    }
                } catch (Exception $e) {
                    // Failed to decode error response.
                }
            }

            throw ExceptionFactory::create($statusCode, $message, $request, $response);
        }
    }

    /**
     * Fetches the response of the request. This method is blocking and will wait for the request to actually finish.
     * If the request has not been sent to the server yet, it will be sent with this method call.
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ApiClientException
     */
    public function fetchResponse(RequestInterface $request): ResponseInterface
    {
        $requestId = $this->getRequestId($request);
        if (!isset($this->pendingRequests[$requestId])) {
            $this->sendRequest($request);
        }

        try {
            $response = $this->pendingRequests[$requestId]->wait();
        } finally {
            unset($this->pendingRequests[$requestId]);
        }
        return $response;
    }

    /**
     * Returns the unique id of the request.
     * @param RequestInterface $request
     * @return int
     */
    protected function getRequestId(RequestInterface $request): int
    {
        return spl_object_id($request);
    }
}
