<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemProductEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemProductEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemProductEndpoint
 */
class ItemProductEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemProductRequest();
        $request->combinationId = 'abc';

        $instance = new ItemProductEndpoint();
        $this->assertSame(ItemProductRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/item/product', $instance->getRequestPath($request));
        $this->assertSame(ItemProductResponse::class, $instance->getResponseClass());
    }
}
