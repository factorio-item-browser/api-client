<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item product response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse
 */
class ItemProductResponseTest extends TestCase
{
    public function testConstruct(): void
    {
        $instance = new ItemProductResponse();

        $this->assertEquals(new GenericEntityWithRecipes(), $instance->item);
    }
}
