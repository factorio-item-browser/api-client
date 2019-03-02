<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Endpoint\Mod;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\Mod\ModMetaRequest;
use FactorioItemBrowser\Api\Client\Response\Mod\ModMetaResponse;

/**
 * The endpoint of the mod meta request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModMetaEndpoint implements EndpointInterface
{
    /**
     * Returns the request class supported by the endpoint.
     * @return string
     */
    public function getSupportedRequestClass(): string
    {
        return ModMetaRequest::class;
    }

    /**
     * Returns whether or not this endpoint requires an authorization token.
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
        return 'mod/meta';
    }

    /**
     * Creates the response of the endpoint.
     * @return string
     */
    public function getResponseClass(): string
    {
        return ModMetaResponse::class;
    }
}
