<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
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
        $this->assertSame('', $entity->getType());
        $this->assertSame('', $entity->getName());
        $this->assertSame('', $entity->getLabel());
        $this->assertSame('', $entity->getDescription());
        $this->assertSame([], $entity->getRecipes());
        $this->assertSame(0, $entity->getTotalNumberOfRecipes());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @covers ::setRecipes
     * @covers ::addRecipe
     * @covers ::getRecipes
     */
    public function testSetAddAndGetRecipes()
    {
        $recipe1 = new RecipeWithExpensiveVersion();
        $recipe1->setMode('abc');
        $recipe2 = new RecipeWithExpensiveVersion();
        $recipe2->setMode('def');
        $recipe3 = new RecipeWithExpensiveVersion();
        $recipe3->setMode('ghi');

        $entity = new GenericEntityWithRecipes();
        $this->assertSame($entity, $entity->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $entity->getRecipes());

        $this->assertSame($entity, $entity->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $entity->getRecipes());
    }

    /**
     * Tests setting and getting the total number of recipes.
     * @covers ::setTotalNumberOfRecipes
     * @covers ::getTotalNumberOfRecipes
     */
    public function testSetAndGetTotalNumberOfRecipes()
    {
        $entity = new GenericEntityWithRecipes();
        $this->assertSame($entity, $entity->setTotalNumberOfRecipes(42));
        $this->assertSame(42, $entity->getTotalNumberOfRecipes());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $recipe1 = new RecipeWithExpensiveVersion();
        $recipe1->setMode('r1');
        $recipe2 = new RecipeWithExpensiveVersion();
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
        $this->assertSame($newEntity, $newEntity->readData(new DataContainer($data)));
        $this->assertEquals($newEntity, $entity);
    }
}
