<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Mod;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;

/**
 * The endpoint of the mod list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<ModListRequest, ModListResponse>
 */
class ModListEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return ModListRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/mod/list";
    }

    public function getResponseClass(): string
    {
        return ModListResponse::class;
    }
}
