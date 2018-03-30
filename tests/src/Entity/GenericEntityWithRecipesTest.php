<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic entity with recipes class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes
 */
class GenericEntityWithRecipesTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $entity = new GenericEntityWithRecipes();
        $this->assertEquals('', $entity->getType());
        $this->assertEquals('', $entity->getName());
        $this->assertEquals('', $entity->getLabel());
        $this->assertEquals('', $entity->getDescription());
        $this->assertEquals([], $entity->getRecipes());
        $this->assertEquals(0, $entity->getTotalNumberOfRecipes());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @covers ::setRecipes
     * @covers ::addRecipe
     * @covers ::getRecipes
     */
    public function testSetAddAndGetRecipes()
    {
        $recipe1 = new Recipe();
        $recipe1->setMode('abc');
        $recipe2 = new Recipe();
        $recipe2->setMode('def');
        $recipe3 = new Recipe();
        $recipe3->setMode('ghi');

        $entity = new GenericEntityWithRecipes();
        $this->assertEquals($entity, $entity->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertEquals([$recipe1, $recipe2], $entity->getRecipes());

        $this->assertEquals($entity, $entity->addRecipe($recipe3));
        $this->assertEquals([$recipe1, $recipe2, $recipe3], $entity->getRecipes());
    }

    /**
     * Tests setting and getting the total number of recipes.
     * @covers ::setTotalNumberOfRecipes
     * @covers ::getTotalNumberOfRecipes
     */
    public function testSetAndGetTotalNumberOfRecipes()
    {
        $entity = new GenericEntityWithRecipes();
        $this->assertEquals($entity, $entity->setTotalNumberOfRecipes(42));
        $this->assertEquals(42, $entity->getTotalNumberOfRecipes());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $recipe1 = new Recipe();
        $recipe1->setMode('r1');
        $recipe2 = new Recipe();
        $recipe2->setMode('r2');

        $entity = new GenericEntityWithRecipes();
        $entity
            ->setType('abc')
            ->setName('def')
            ->setLabel('ghi')
            ->setDescription('jkl')
            ->addRecipe($recipe1)
            ->addRecipe($recipe2)
            ->setTotalNumberOfRecipes(42);

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'recipes' => [
                [
                    'name' => '',
                    'mode' => 'r1',
                    'label' => '',
                    'description' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.
                ],
                [
                    'name' => '',
                    'mode' => 'r2',
                    'label' => '',
                    'description' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.
                ],
            ],
            'totalNumberOfRecipes' => 42
        ];

        $data = $entity->writeData();
        $this->assertEquals($expectedData, $data);

        $newEntity = new GenericEntityWithRecipes();
        $this->assertEquals($newEntity, $newEntity->readData(new DataContainer($data)));
        $this->assertEquals($newEntity, $entity);
    }
}
