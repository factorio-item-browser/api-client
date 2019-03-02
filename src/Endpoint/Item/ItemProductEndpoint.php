<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;

/**
 * The endpoint of the item product request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return ItemProductRequest::class;
    }

    /**
     * Returns whether or not this query requires an authorization token.
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
        return 'item/product';
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return ItemProductResponse::class;
    }
}
