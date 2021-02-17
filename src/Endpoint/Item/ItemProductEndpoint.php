<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;

/**
 * The endpoint of the item product request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<ItemProductRequest, ItemProductResponse>
 */
class ItemProductEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return ItemProductRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/item/product";
    }

    public function getResponseClass(): string
    {
        return ItemProductResponse::class;
    }
}
