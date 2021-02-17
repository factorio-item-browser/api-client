<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client;

use FactorioItemBrowser\Api\Client\Endpoint\EndpointInterface;
use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * A endpoint implementation for testing.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements EndpointInterface<TestRequest, TestResponse>
 */
class TestEndpoint implements EndpointInterface
{
    public function getHandledRequestClass(): string
    {
        return TestRequest::class;
    }

    public function getRequestPath(AbstractRequest $request): string
    {
        return "{$request->combinationId}/test";
    }

    public function getResponseClass(): string
    {
        return TestResponse::class;
    }
}
