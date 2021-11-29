<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Meta;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Meta\StatusRequest;
use FactorioItemBrowser\Api\Client\Response\Meta\StatusResponse;

/**
 * The endpoint of the status request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<StatusRequest, StatusResponse>
 */
class StatusEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return StatusRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}";
    }

    public function getResponseClass(): string
    {
        return StatusResponse::class;
    }
}
