<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Recipe;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeMachinesResponse;

/**
 * The endpoint of the recipe machines request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<RecipeMachinesRequest, RecipeMachinesResponse>
 */
class RecipeMachinesEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return RecipeMachinesRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/recipe/machines";
    }

    public function getResponseClass(): string
    {
        return RecipeMachinesResponse::class;
    }
}
