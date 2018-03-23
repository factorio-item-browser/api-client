<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response;

use BluePsyduck\MultiCurl\Entity\Request;
use FactorioItemBrowser\Api\Client\Client\Client;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;

/**
 * The class wrapping around a still pending response.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class PendingResponse
{
    /**
     * The client executing the request.
     * @var Client
     */
    protected $client;

    /**
     * The request which is pending.
     * @var Request
     */
    protected $clientRequest;

    /**
     * Initializes the pending response.
     * @param Client $client
     * @param Request $clientRequest
     */
    public function __construct(Client $client, Request $clientRequest)
    {
        $this->client = $client;
        $this->clientRequest = $clientRequest;
    }

    /**
     * Fetches the response by waiting until the request is actually finished.
     * @return array
     * @throws ApiClientException
     */
    public function fetchResponse(): array
    {
        try {
            $responseData = $this->client->fetchResponse($this->clientRequest);
        } catch (UnauthorizedException $e) {
            $this->client->requestAuthorizationToken();

            $clientRequest = clone($this->clientRequest);
            $this->client->executeRequest($clientRequest);
            $responseData = $this->client->fetchResponse($clientRequest);
        }
        return $responseData;
    }
}