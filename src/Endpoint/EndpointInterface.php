<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint;

/**
 * The interface of the endpoint classes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string;

    /**
     * Returns whether or not this endpoint requires an authorization token.
     * @return bool
     */
    public function requiresAuthorizationToken(): bool;

    /**
     * Returns the request path of the endpoint.
     * @return string
     */
    public function getRequestPath(): string;

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string;
}
