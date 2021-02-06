<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Mod;

use FactorioItemBrowser\Api\Client\Endpoint\Mod\ModListEndpoint;
use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowser\Api\Client\Response\Mod\ModListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ModListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Mod\ModListEndpoint
 */
class ModListEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new ModListRequest();
        $request->combinationId = 'abc';

        $instance = new ModListEndpoint();
        $this->assertSame(ModListRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/mod/list', $instance->getRequestPath($request));
        $this->assertSame(ModListResponse::class, $instance->getResponseClass());
    }
}
