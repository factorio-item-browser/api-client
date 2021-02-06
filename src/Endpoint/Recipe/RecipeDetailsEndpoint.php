<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;

/**
 * The endpoint of the recipe details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<RecipeDetailsRequest, RecipeDetailsResponse>
 */
class RecipeDetailsEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return RecipeDetailsRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/recipe/details";
    }

    public function getResponseClass(): string
    {
        return RecipeDetailsResponse::class;
    }
}
