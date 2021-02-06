<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Endpoint\Item;

use FactorioItemBrowser\Api\Client\Endpoint\Item\ItemIngredientEndpoint;
use FactorioItemBrowser\Api\Client\Request\Item\ItemIngredientRequest;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ItemIngredientEndpoint class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Endpoint\Item\ItemIngredientEndpoint
 */
class ItemIngredientEndpointTest extends TestCase
{
    public function test(): void
    {
        $request = new ItemIngredientRequest();
        $request->combinationId = 'abc';

        $instance = new ItemIngredientEndpoint();
        $this->assertSame(ItemIngredientRequest::class, $instance->getHandledRequestClass());
        $this->assertSame('abc/item/ingredient', $instance->getRequestPath($request));
        $this->assertSame(ItemIngredientResponse::class, $instance->getResponseClass());
    }
}
