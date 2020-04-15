<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client;

use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The interface of the API client class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface ApiClientInterface
{
    /**
     * Sets the locale to use for the requests.
     * @param string $locale
     */
    public function setLocale(string $locale): void;

    /**
     * Sets the mod names to use on authorization.
     * @param array|string[] $modNames
     */
    public function setModNames(array $modNames): void;

    /**
     * Sets the authorization token to use for the requests.
     * @param string $authorizationToken
     */
    public function setAuthorizationToken(string $authorizationToken): void;

    /**
     * Returns the authorization token from the last request.
     * @return string
     */
    public function getAuthorizationToken(): string;

    /**
     * Clears the authorization token to trigger a re-authorization on the next request.
     */
    public function clearAuthorizationToken(): void;

    /**
     * Sends the request to the API server. This method is non-blocking and will not wait for the request to actually
     * finish.
     * @param RequestInterface $request
     * @throws ApiClientException
     */
    public function sendRequest(RequestInterface $request): void;

    /**
     * Fetches the response of the request. This method is blocking and will wait for the request to actually finish.
     * If the request has not been sent to the server yet, it will be sent with this method call.
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ApiClientException
     */
    public function fetchResponse(RequestInterface $request): ResponseInterface;
}
