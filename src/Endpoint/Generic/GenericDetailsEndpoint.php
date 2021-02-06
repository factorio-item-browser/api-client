<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;

/**
 * The endpoint of the generic details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<GenericDetailsRequest, GenericDetailsResponse>
 */
class GenericDetailsEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return GenericDetailsRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/generic/details";
    }

    public function getResponseClass(): string
    {
        return GenericDetailsResponse::class;
    }
}
