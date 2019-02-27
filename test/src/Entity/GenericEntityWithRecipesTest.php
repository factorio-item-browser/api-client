<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
    public function testConstruct(): void
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
     * @throws ReflectionException
     * @covers ::setRecipes
     * @covers ::addRecipe
     * @covers ::getRecipes
     */
    public function testSetAddAndGetRecipes(): void
    {
        /* @var RecipeWithExpensiveVersion&MockObject $recipe1 */
        $recipe1 = $this->createMock(RecipeWithExpensiveVersion::class);
        /* @var RecipeWithExpensiveVersion&MockObject $recipe2 */
        $recipe2 = $this->createMock(RecipeWithExpensiveVersion::class);
        /* @var RecipeWithExpensiveVersion&MockObject $recipe3 */
        $recipe3 = $this->createMock(RecipeWithExpensiveVersion::class);

        $entity = new GenericEntityWithRecipes();
        $this->assertSame($entity, $entity->setRecipes([$recipe1, $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $entity->getRecipes());

        $this->assertSame($entity, $entity->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $entity->getRecipes());
    }

    /**
     * Tests the setting and getting the total number of recipes.
     * @covers ::getTotalNumberOfRecipes
     * @covers ::setTotalNumberOfRecipes
     */
    public function testSetAndGetTotalNumberOfRecipes(): void
    {
        $totalNumberOfRecipes = 42;
        $entity = new GenericEntityWithRecipes();

        $this->assertSame($entity, $entity->setTotalNumberOfRecipes($totalNumberOfRecipes));
        $this->assertSame($totalNumberOfRecipes, $entity->getTotalNumberOfRecipes());
    }
}
