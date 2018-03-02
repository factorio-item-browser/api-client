<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\EntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the entity with recipes class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Entity\EntityWithRecipes
 */
class EntityWithRecipesTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals('', $entity->getType());
        $this->assertEquals('', $entity->getName());
        $this->assertEquals('', $entity->getLabel());
        $this->assertEquals('', $entity->getDescription());
        $this->assertEquals([], $entity->getRecipes());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setType('abc'));
        $this->assertEquals('abc', $entity->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setName('abc'));
        $this->assertEquals('abc', $entity->getName());
    }

    /**
     * Tests setting and getting the label.
     */
    public function testSetAndGetLabel()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setLabel('abc'));
        $this->assertEquals('abc', $entity->getLabel());
    }

    /**
     * Tests setting and getting the description.
     */
    public function testSetAndGetDescription()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setDescription('abc'));
        $this->assertEquals('abc', $entity->getDescription());
    }

    /**
     * Tests setting, adding and getting the recipes.
     */
    public function testSetAddAndGetRecipes()
    {
        $recipe1 = new Recipe();
        $recipe1->setMode('abc');
        $recipe2 = new Recipe();
        $recipe2->setMode('def');
        $recipe3 = new Recipe();
        $recipe3->setMode('ghi');

        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertEquals([$recipe1, $recipe2], $entity->getRecipes());

        $this->assertEquals($entity, $entity->addRecipe($recipe3));
        $this->assertEquals([$recipe1, $recipe2, $recipe3], $entity->getRecipes());
    }

    /**
     * Tests writing and reading the data.
     */
    public function testWriteAndReadData()
    {
        $recipe1 = new Recipe();
        $recipe1->setMode('r1');
        $recipe2 = new Recipe();
        $recipe2->setMode('r2');

        $entity = new EntityWithRecipes();
        $entity->setType('abc')
               ->setName('def')
               ->setLabel('ghi')
               ->setDescription('jkl')
               ->addRecipe($recipe1)
               ->addRecipe($recipe2);

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'recipes' => [
                [
                    'mode' => 'r1',
                    'name' => '',
                    'label' => '',
                    'description' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.
                ],
                [
                    'mode' => 'r2',
                    'name' => '',
                    'label' => '',
                    'description' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.
                ],
            ]
        ];

        $data = $entity->writeData();
        $this->assertEquals($expectedData, $data);

        $newEntity = new EntityWithRecipes();
        $this->assertEquals($newEntity, $newEntity->readData(new DataContainer($data)));
        $this->assertEquals($newEntity, $entity);
    }
}
