<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemListEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemListEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemListEndpoint
 */
class ItemListEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemListRequest();
        $request->combinationId = 'abc';

        $instance = new ItemListEndpoint();
        $this->assertSame(ItemListRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/item/list', $instance->getRequestPath($request));
        $this->assertSame(ItemListResponse::class, $instance->getResponseClass());
    }
}
