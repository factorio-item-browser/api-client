<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Recipe;
use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Common\Constant\EntityType;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
    public function testConstruct(): void
    {
        $recipe = new RecipeWithExpensiveVersion();

        $this->assertSame(EntityType::RECIPE, $recipe->getType());
        $this->assertSame('', $recipe->getName());
        $this->assertSame('', $recipe->getMode());
        $this->assertSame('', $recipe->getLabel());
        $this->assertSame('', $recipe->getDescription());
        $this->assertSame([], $recipe->getIngredients());
        $this->assertSame([], $recipe->getProducts());
        $this->assertSame(0., $recipe->getCraftingTime());
        $this->assertNull($recipe->getExpensiveVersion());
    }

    /**
     * Tests setting and getting the expensive version.
     * @throws ReflectionException
     * @covers ::getExpensiveVersion
     * @covers ::hasExpensiveVersion
     * @covers ::setExpensiveVersion
     */
    public function testSetHasAndGetExpensiveVersion()
    {
        /* @var Recipe&MockObject $expensiveVersion */
        $expensiveVersion = $this->createMock(Recipe::class);

        $recipe = new RecipeWithExpensiveVersion();
        $this->assertFalse($recipe->hasExpensiveVersion());
        $this->assertSame($recipe, $recipe->setExpensiveVersion($expensiveVersion));

        $this->assertTrue($recipe->hasExpensiveVersion());
        $this->assertSame($expensiveVersion, $recipe->getExpensiveVersion());
    }
}
