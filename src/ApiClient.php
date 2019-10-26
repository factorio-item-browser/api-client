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
use Psr\Http\Message\MessageInterface as PsrMessageInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * The API client class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ApiClient implements ApiClientInterface
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
     * Sets the locale to use for the requests.
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->options->setLocale($locale);
    }

    /**
     * Sets the mod names to enabled on authorization.
     * @param array|string[] $enabledModNames
     */
    public function setModNames(array $enabledModNames): void
    {
        $this->options->setModNames($enabledModNames);
    }

    /**
     * Sets the authorization token to use for the requests.
     * @param string $authorizationToken
     */
    public function setAuthorizationToken(string $authorizationToken): void
    {
        $this->options->setAuthorizationToken($authorizationToken);
    }

    /**
     * Returns the authorization token from the last request.
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->options->getAuthorizationToken();
    }

    /**
     * Clears the authorization token to trigger a re-authorization on the next request.
     */
    public function clearAuthorizationToken(): void
    {
        $this->options->setAuthorizationToken('');
    }

    /**
     * Sends the request to the API server. This method is non-blocking and will not wait for the request to actually
     * finish.
     * @param RequestInterface $request
     * @throws ApiClientException
     */
    public function sendRequest(RequestInterface $request): void
    {
        $requestId = $this->getRequestId($request);
        $this->pendingRequests[$requestId] = $this->createPromiseForRequest($request, true);
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
            $this->pendingRequests[$requestId] = $this->createPromiseForRequest($request, true);
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

    /**
     * Creates and returns the promise for the request. This will actually send the request to the API server.
     * @param RequestInterface $request
     * @param bool $processApiException
     * @return PromiseInterface
     * @throws ApiClientException
     */
    protected function createPromiseForRequest(RequestInterface $request, bool $processApiException): PromiseInterface
    {
        $clientRequest = $this->createClientRequest($request);
        $promise = $this->guzzleClient->sendAsync($clientRequest);
        $promise = $promise->then(
            function (PsrResponseInterface $clientResponse) use ($request, $clientRequest): ResponseInterface {
                return $this->processResponse($request, $clientRequest, $clientResponse);
            },
            function (RequestException $exception): void {
                $this->processException($exception);
            }
        );

        if ($processApiException) {
            $promise = $promise->then(
                null,
                function (ApiClientException $exception) use ($request): ResponseInterface {
                    return $this->processApiClientException($exception, $request);
                }
            );
        }

        return $promise;
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
        $result = $this->options->getAuthorizationToken();
        if ($result === '') {
            $authRequest = new AuthRequest();
            $authRequest->setAccessKey($this->options->getAccessKey())
                        ->setModNames($this->options->getModNames());

            $authResponse = $this->fetchResponse($authRequest);
            if ($authResponse instanceof AuthResponse) {
                $result = $authResponse->getAuthorizationToken();
                $this->options->setAuthorizationToken($result);
            }
        }
        return $result;
    }

    /**
     * Processes the response received from the HTTP client.
     * @param RequestInterface $request
     * @param PsrRequestInterface $clientRequest
     * @param PsrResponseInterface $clientResponse
     * @return ResponseInterface
     * @throws ApiClientException
     */
    protected function processResponse(
        RequestInterface $request,
        PsrRequestInterface $clientRequest,
        PsrResponseInterface $clientResponse
    ): ResponseInterface {
        $endpoint = $this->endpointService->getEndpointForRequest($request);
        $responseContents = $this->getContentsFromMessage($clientResponse);

        try {
            $result = $this->serializer->deserialize($responseContents, $endpoint->getResponseClass(), 'json');
        } catch (Exception $e) {
            $requestContents = $this->getContentsFromMessage($clientRequest);
            throw new InvalidResponseException($e->getMessage(), $requestContents, $responseContents, $e);
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
        $requestContents = $this->getContentsFromMessage($exception->getRequest());
        $responseContents = $this->getContentsFromMessage($exception->getResponse());

        if ($exception instanceof ConnectException) {
            throw new ConnectionException($exception->getMessage(), $requestContents, $exception);
        } else {
            $message = $this->extractMessageFromErrorResponse($responseContents, $exception->getMessage());
            $statusCode = 0;
            if ($exception->getResponse() instanceof PsrResponseInterface) {
                $statusCode = $exception->getResponse()->getStatusCode();
            }

            throw $this->createApiClientException($statusCode, $message, $requestContents, $responseContents);
        }
    }

    /**
     * Tries to extract the message from an error response.
     * @param string $responseContents
     * @param string $fallbackMessage
     * @return string
     */
    protected function extractMessageFromErrorResponse(string $responseContents, string $fallbackMessage): string
    {
        $result = $fallbackMessage;
        try {
            $errorResponse = $this->serializer->deserialize($responseContents, ErrorResponse::class, 'json');

            if ($errorResponse instanceof ErrorResponse) {
                $result = $errorResponse->getError()->getMessage();
            }
        } catch (Exception $e) {
            // Failed to decode error response.
        }
        return $result;
    }

    /**
     * Returns the contents of the message (i.e. request or response), if it is an actual instance.
     * @param PsrMessageInterface $message
     * @return string
     */
    protected function getContentsFromMessage(?PsrMessageInterface $message): string
    {
        $result = '';
        if ($message !== null) {
            $result = $message->getBody()->getContents();
        }
        return $result;
    }

    /**
     * Creates an API exception to throw.
     * @param int $statusCode
     * @param string $message
     * @param string $requestContents
     * @param string $responseContents
     * @return ApiClientException
     */
    protected function createApiClientException(
        $statusCode,
        $message,
        $requestContents,
        $responseContents
    ): ApiClientException {
        return ExceptionFactory::create($statusCode, $message, $requestContents, $responseContents);
    }

    /**
     * Processes an API client exception checking if authorization has to be renewed.
     * @param ApiClientException $exception
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ApiClientException
     */
    protected function processApiClientException(
        ApiClientException $exception,
        RequestInterface $request
    ): ResponseInterface {
        if (!$exception instanceof UnauthorizedException) {
            throw $exception;
        }

        $this->clearAuthorizationToken();
        $promise = $this->createPromiseForRequest($request, false);
        return $promise->wait();
    }
}
