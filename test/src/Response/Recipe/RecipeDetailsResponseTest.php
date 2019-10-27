<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe details response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse
 */
class RecipeDetailsResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new RecipeDetailsResponse();

        $this->assertSame([], $response->getRecipes());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @covers ::addRecipe
     * @covers ::setRecipes
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

        $response = new RecipeDetailsResponse();
        $this->assertSame($response, $response->setRecipes([$recipe1, $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $response->getRecipes());

        $this->assertSame($response, $response->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $response->getRecipes());
    }
}
