<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe with expensive version class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion
 */
class RecipeWithExpensiveVersionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $recipe = new RecipeWithExpensiveVersion();
        $this->assertSame('recipe', $recipe->getType());
        $this->assertSame('', $recipe->getName());
        $this->assertSame('', $recipe->getMode());
        $this->assertSame('', $recipe->getLabel());
        $this->assertSame('', $recipe->getDescription());
        $this->assertSame([], $recipe->getIngredients());
        $this->assertSame([], $recipe->getProducts());
        $this->assertSame(0., $recipe->getCraftingTime());
        $this->assertSame(null, $recipe->getExpensiveVersion());
    }

    /**
     * Tests setting and getting the mode.
     * @covers ::getExpensiveVersion
     * @covers ::hasExpensiveVersion
     * @covers ::setExpensiveVersion
     */
    public function testSetHasAndGetMode()
    {
        $expensiveVersion = new Recipe();
        $expensiveVersion->setName('abc');

        $recipe = new RecipeWithExpensiveVersion();
        $this->assertSame(false, $recipe->hasExpensiveVersion());
        $this->assertSame($recipe, $recipe->setExpensiveVersion($expensiveVersion));
        $this->assertSame(true, $recipe->hasExpensiveVersion());
        $this->assertSame($expensiveVersion, $recipe->getExpensiveVersion());
    }


    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $item1 = new Item();
        $item1->setType('i1');
        $item2 = new Item();
        $item2->setType('i2');
        $item3 = new Item();
        $item3->setType('i3');
        $item4 = new Item();
        $item4->setType('i4');

        $expensiveVersion = new Recipe();
        $expensiveVersion->setName('foo');

        $recipe = new RecipeWithExpensiveVersion();
        $recipe->setName('abc')
               ->setMode('def')
               ->setLabel('ghi')
               ->setDescription('jkl')
               ->addIngredient($item1)
               ->addIngredient($item2)
               ->addProduct($item3)
               ->addProduct($item4)
               ->setCraftingTime(13.37)
               ->setExpensiveVersion($expensiveVersion);

        $expectedData = [
            'name' => 'abc',
            'mode' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'ingredients' => [
                ['type' => 'i1', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0.],
                ['type' => 'i2', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0.]
            ],
            'products' => [
                ['type' => 'i3', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0.],
                ['type' => 'i4', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0.]
            ],
            'craftingTime' => 13.37,
            'expensiveVersion' => [
                'name' => 'foo',
                'mode' => '',
                'label' => '',
                'description' => '',
                'ingredients' => [],
                'products' => [],
                'craftingTime' => 0.
            ]
        ];

        $data = $recipe->writeData();
        $this->assertEquals($expectedData, $data);

        $newRecipe = new RecipeWithExpensiveVersion();
        $this->assertSame($newRecipe, $newRecipe->readData(new DataContainer($data)));
        $this->assertEquals($newRecipe, $recipe);
    }
}
