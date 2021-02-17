<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Item\ItemIngredientRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;

/**
 * The endpoint of the item ingredient request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<ItemIngredientRequest, ItemIngredientResponse>
 */
class ItemIngredientEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return ItemIngredientRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/item/ingredient";
    }

    public function getResponseClass(): string
    {
        return ItemIngredientResponse::class;
    }
}
