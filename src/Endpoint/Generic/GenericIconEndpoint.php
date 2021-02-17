<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Generic;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericIconResponse;

/**
 * The endpoint of the generic icon request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<GenericIconRequest, GenericIconResponse>
 */
class GenericIconEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return GenericIconRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/generic/icon";
    }

    public function getResponseClass(): string
    {
        return GenericIconResponse::class;
    }
}
