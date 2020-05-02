<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeListResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RecipeListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Recipe\RecipeListResponse
 */
class RecipeListResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new RecipeListResponse();

        $this->assertSame([], $response->getRecipes());
        $this->assertSame(0, $response->getTotalNumberOfResults());
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

        $response = new RecipeListResponse();
        $this->assertSame($response, $response->setRecipes([$recipe1, $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $response->getRecipes());

        $this->assertSame($response, $response->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $response->getRecipes());
    }

    /**
     * Tests the setting and getting the total number of results.
     * @covers ::getTotalNumberOfResults
     * @covers ::setTotalNumberOfResults
     */
    public function testSetAndGetTotalNumberOfResults(): void
    {
        $totalNumberOfResults = 42;
        $response = new RecipeListResponse();

        $this->assertSame($response, $response->setTotalNumberOfResults($totalNumberOfResults));
        $this->assertSame($totalNumberOfResults, $response->getTotalNumberOfResults());
    }
}
