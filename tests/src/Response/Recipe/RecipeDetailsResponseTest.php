<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use FactorioItemBrowserTestAsset\Api\Client\Response\TestPendingResponse;
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
     * Tests mapping and getting the authorization token.
     * @covers ::getRecipes
     * @covers ::mapResponse
     */
    public function testGetAuthorizationToken()
    {
        $responseData = [
            'recipes' => [
                ['name' => 'abc'],
                ['name' => 'def']
            ]
        ];
        $recipe1 = new Recipe();
        $recipe1->setName('abc');
        $recipe2 = new Recipe();
        $recipe2->setName('def');

        $response = new RecipeDetailsResponse(new TestPendingResponse($responseData));
        $this->assertEquals([$recipe1, $recipe2], $response->getRecipes());
    }

    /**
     * Tests mapping and getting the meta data.
     * @coversNothing
     */
    public function testGetMeta()
    {
        $responseData = [
            'meta' => [
                'executionTime' => 13.37
            ]
        ];
        $expectedMeta = new Meta();
        $expectedMeta->setExecutionTime(13.37);

        $response = new RecipeDetailsResponse(new TestPendingResponse($responseData));
        $this->assertEquals($expectedMeta, $response->getMeta());
    }
}
