<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item ingredient response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse
 */
class ItemIngredientResponseTest extends TestCase
{
    /**
     * Tests mapping and getting the authorization token.
     * @covers ::getItem
     * @covers ::getGroupedRecipes
     * @covers ::getTotalNumberOfResults
     * @covers ::mapResponse
     */
    public function testGetAuthorizationToken()
    {
        $responseData = [
            'item' => [
                'name' => 'abc'
            ],
            'groupedRecipes' => [
                ['name' => 'def'],
                ['name' => 'ghi']
            ],
            'totalNumberOfResults' => 42
        ];
        $item = new Item();
        $item->setName('abc');
        $recipe1 = new GenericEntityWithRecipes();
        $recipe1->setName('def');
        $recipe2 = new GenericEntityWithRecipes();
        $recipe2->setName('ghi');

        $response = new ItemIngredientResponse(new TestPendingResponse($responseData));
        $this->assertEquals($item, $response->getItem());
        $this->assertEquals([$recipe1, $recipe2], $response->getGroupedRecipes());
        $this->assertEquals(42, $response->getTotalNumberOfResults());
    }

    /**
     * Tests mapping and getting the meta data.
     * @coversNothing
     */
    public function testGetMeta()
    {
        $responseData = [
            'meta' => [
                'executionTime' => 13.37
            ]
        ];
        $expectedMeta = new Meta();
        $expectedMeta->setExecutionTime(13.37);

        $response = new ItemIngredientResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}
