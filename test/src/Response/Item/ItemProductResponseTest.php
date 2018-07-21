<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item product response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse
 */
class ItemProductResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the item.
     * @covers ::getItem
     * @covers ::mapResponse
     */
    public function testGetItem()
    {
        $responseData = [
            'item' => [
                'name' => 'abc'
            ]
        ];
        $item = new GenericEntityWithRecipes();
        $item->setName('abc');

        $response = new ItemProductResponse(new TestPendingResponse($responseData));
        $this->assertEquals($item, $response->getItem());
    }
}
