<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 *
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
     * @var Client
     */
    protected $guzzleClient;

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
     * @param Client $guzzleClient
     * @param SerializerInterface $serializer
     */
    public function __construct(EndpointService $endpointService, Client $guzzleClient, SerializerInterface $serializer)
    {
        $this->endpointService = $endpointService;
        $this->guzzleClient = $guzzleClient;
        $this->serializer = $serializer;
    }

    /**
     * Sends the request to the API server. This method is asynchronous and will not wait for the request to actually
     * finish.
     * @param RequestInterface $request
     */
    public function sendRequest(RequestInterface $request): void
    {
        $clientRequest = $this->createClientRequest($request);

        $promise = $this->guzzleClient->sendAsync($clientRequest);
        $promise = $promise->then(function (PsrResponseInterface $response) use ($request): ResponseInterface {
            return $this->processResponse($request, $response);
        });

        $this->pendingRequests[$this->getRequestId($request)] = $promise;
    }

    /**
     * Creates the request actually send through the HTTP client.
     * @param RequestInterface $request
     * @return PsrRequestInterface
     */
    protected function createClientRequest(RequestInterface $request): PsrRequestInterface
    {
        $endpoint = $this->endpointService->getEndpointForRequest($request);

        return new Request(
            'POST',
            $endpoint->getRequestPath(),
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            $this->serializer->serialize($request, 'json')
        );
    }

    /**
     * Processes the response received from the HTTP client.
     * @param RequestInterface $request
     * @param PsrResponseInterface $response
     * @return ResponseInterface
     */
    protected function processResponse(RequestInterface $request, PsrResponseInterface $response): ResponseInterface
    {
        $endpoint = $this->endpointService->getEndpointForRequest($request);

        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $endpoint->getResponseClass(),
            'json'
        );
    }

    public function getResponse(RequestInterface $request): ResponseInterface
    {
        $requestId = $this->getRequestId($request);
        var_dump($requestId);
        if (!isset($this->pendingRequests[$requestId])) {
            $this->sendRequest($request);
        }

        $response = $this->pendingRequests[$requestId]->wait();
        unset($this->pendingRequests[$requestId]);
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
