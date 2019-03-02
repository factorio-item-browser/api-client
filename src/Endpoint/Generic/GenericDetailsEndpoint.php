<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;

/**
 * The endpoint of the generic details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return GenericDetailsRequest::class;
    }

    /**
     * Returns whether or not this endpoint requires an authorization token.
     * @return bool
     */
    public function requiresAuthorizationToken(): bool
    {
        return true;
    }

    /**
     * Returns the request path of the endpoint.
     * @return string
     */
    public function getRequestPath(): string
    {
        return 'generic/details';
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return GenericDetailsResponse::class;
    }
}
