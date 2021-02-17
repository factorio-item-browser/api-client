<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;

/**
 * The endpoint of the item random request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<ItemRandomRequest, ItemRandomResponse>
 */
class ItemRandomEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return ItemRandomRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/item/random";
    }

    public function getResponseClass(): string
    {
        return ItemRandomResponse::class;
    }
}
