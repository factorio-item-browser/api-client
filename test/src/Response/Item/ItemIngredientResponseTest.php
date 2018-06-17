<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item ingredient response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse
 */
class ItemIngredientResponseTest extends TestCase
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
        $item = new Item();
        $item->setName('abc');

        $response = new ItemIngredientResponse(new TestPendingResponse($responseData));
        $this->assertEquals($item, $response->getItem());
    }

    /**
     * Tests mapping and getting the grouped recipes.
     * @covers ::getGroupedRecipes
     * @covers ::mapResponse
     */
    public function testGetGroupedRecipes()
    {
        $responseData = [
            'groupedRecipes' => [
                ['name' => 'def'],
                ['name' => 'ghi']
            ],
        ];
        $recipe1 = new GenericEntityWithRecipes();
        $recipe1->setName('def');
        $recipe2 = new GenericEntityWithRecipes();
        $recipe2->setName('ghi');

        $response = new ItemIngredientResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$recipe1, $recipe2], $response->getGroupedRecipes());
    }

    /**
     * Tests mapping and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::mapResponse
     */
    public function testGetTotalNumberOfResults()
    {
        $responseData = [
            'totalNumberOfResults' => 42
        ];

        $response = new ItemIngredientResponse(new TestPendingResponse($responseData));
        $this->assertEquals(42, $response->getTotalNumberOfResults());
    }
}
