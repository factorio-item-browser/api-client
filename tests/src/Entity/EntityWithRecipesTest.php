<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

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
        $this->assertEquals('', $entity->getGroup());
        $this->assertEquals('', $entity->getType());
        $this->assertEquals('', $entity->getName());
        $this->assertEquals('', $entity->getLabel());
        $this->assertEquals('', $entity->getDescription());
        $this->assertEquals([], $entity->getRecipes());
        $this->assertEquals('', $entity->getTranslationType());
    }

    /**
     * Tests setting and getting the group.
     */
    public function testSetAndGetGroup()
    {
        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setGroup('abc'));
        $this->assertEquals('abc', $entity->getGroup());
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
        $recipe1->setType('abc');
        $recipe2 = new Recipe();
        $recipe2->setType('def');
        $recipe3 = new Recipe();
        $recipe3->setType('ghi');

        $entity = new EntityWithRecipes();
        $this->assertEquals($entity, $entity->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertEquals([$recipe1, $recipe2], $entity->getRecipes());

        $this->assertEquals($entity, $entity->addRecipe($recipe3));
        $this->assertEquals([$recipe1, $recipe2, $recipe3], $entity->getRecipes());
    }

    /**
     * Provides the data for the getTranslationType() test.
     */
    public function provideGetTranslationType(): array
    {
        return [
            ['item', 'item', 'item'],
            ['item', 'fluid', 'fluid'],
            ['recipe', 'normal', 'recipe'],
            ['recipe', 'expensive', 'recipe'],
        ];
    }

    /**
     * Tests getting the translation type.
     * @param string $group
     * @param string $type
     * @param string $expectedResult
     * @dataProvider provideGetTranslationType
     */
    public function testGetTranslationType(string $group, string $type, string $expectedResult)
    {
        $entity = new EntityWithRecipes();
        $entity->setGroup($group)
               ->setType($type);
        $this->assertEquals($expectedResult, $entity->getTranslationType());
    }
}
