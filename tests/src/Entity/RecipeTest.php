<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Entity\Recipe
 */
class RecipeTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $recipe = new Recipe();
        $this->assertEquals('', $recipe->getType());
        $this->assertEquals('', $recipe->getName());
        $this->assertEquals('', $recipe->getLabel());
        $this->assertEquals('', $recipe->getDescription());
        $this->assertEquals([], $recipe->getIngredients());
        $this->assertEquals([], $recipe->getProducts());
        $this->assertEquals(0., $recipe->getCraftingTime());
        $this->assertEquals('recipe', $recipe->getTranslationType());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setType('abc'));
        $this->assertEquals('abc', $recipe->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setName('abc'));
        $this->assertEquals('abc', $recipe->getName());
    }

    /**
     * Tests setting and getting the label.
     */
    public function testSetAndGetLabel()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setLabel('abc'));
        $this->assertEquals('abc', $recipe->getLabel());
    }

    /**
     * Tests setting and getting the description.
     */
    public function testSetAndGetDescription()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setDescription('abc'));
        $this->assertEquals('abc', $recipe->getDescription());
    }

    /**
     * Tests setting, adding and getting the ingredients.
     */
    public function testSetAddAndGetIngredients()
    {
        $item1 = new Item();
        $item1->setType('abc');
        $item2 = new Item();
        $item2->setType('def');
        $item3 = new Item();
        $item3->setType('ghi');

        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setIngredients([$item1, new Recipe(), $item2]));
        $this->assertEquals([$item1, $item2], $recipe->getIngredients());

        $this->assertEquals($recipe, $recipe->addIngredient($item3));
        $this->assertEquals([$item1, $item2, $item3], $recipe->getIngredients());
    }

    /**
     * Tests setting, adding and getting the products.
     */
    public function testSetAddAndGetProducts()
    {
        $item1 = new Item();
        $item1->setType('abc');
        $item2 = new Item();
        $item2->setType('def');
        $item3 = new Item();
        $item3->setType('ghi');

        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setProducts([$item1, new Recipe(), $item2]));
        $this->assertEquals([$item1, $item2], $recipe->getProducts());

        $this->assertEquals($recipe, $recipe->addProduct($item3));
        $this->assertEquals([$item1, $item2, $item3], $recipe->getProducts());
    }

    /**
     * Tests setting and getting the craftingTime.
     */
    public function testSetAndGetCraftingTime()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setCraftingTime(13.37));
        $this->assertEquals(13.37, $recipe->getCraftingTime());
    }

    /**
     * Tests getting the translation type.
     */
    public function testGetTranslationType()
    {
        $recipe = new Recipe();
        $this->assertEquals('recipe', $recipe->getTranslationType());
    }

    /**
     * Tests writing and reading the data.
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

        $recipe = new Recipe();
        $recipe->setType('abc')
               ->setName('def')
               ->setLabel('ghi')
               ->setDescription('jkl')
               ->addIngredient($item1)
               ->addIngredient($item2)
               ->addProduct($item3)
               ->addProduct($item4)
               ->setCraftingTime(13.37);

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'ingredients' => [
                ['type' => 'i1', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0],
                ['type' => 'i2', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0]
            ],
            'products' => [
                ['type' => 'i3', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0],
                ['type' => 'i4', 'name' => '', 'label' => '', 'description' => '', 'amount' => 0]
            ],
            'craftingTime' => 13.37
        ];

        $data = $recipe->writeData();
        $this->assertEquals($expectedData, $data);

        $newRecipe = new Recipe();
        $this->assertEquals($newRecipe, $newRecipe->readData(new DataContainer($data)));
        $this->assertEquals($newRecipe, $recipe);
    }
}
