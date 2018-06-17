<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item random response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse
 */
class ItemRandomResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the items.
     * @covers ::getItems
     * @covers ::mapResponse
     */
    public function testGetItems()
    {
        $responseData = [
            'items' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $item1 = new GenericEntityWithRecipes();
        $item1->setName('abc');
        $item2 = new GenericEntityWithRecipes();
        $item2->setName('def');

        $response = new ItemRandomResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$item1, $item2], $response->getItems());
    }
}
