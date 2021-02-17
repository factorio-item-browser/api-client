<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemRandomEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemRandomEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemRandomEndpoint
 */
class ItemRandomEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemRandomRequest();
        $request->combinationId = 'abc';

        $instance = new ItemRandomEndpoint();
        $this->assertSame(ItemRandomRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/item/random', $instance->getRequestPath($request));
        $this->assertSame(ItemRandomResponse::class, $instance->getResponseClass());
    }
}
