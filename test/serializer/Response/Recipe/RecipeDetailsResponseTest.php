<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the RecipeDetailsResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class RecipeDetailsResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $recipe1 = new RecipeWithExpensiveVersion();
        $recipe1->setName('abc')
                ->setLabel('def')
                ->setDescription('ghi')
                ->setMode('jkl')
                ->setCraftingTime(13.37);

        $recipe2 = new RecipeWithExpensiveVersion();
        $recipe2->setName('mno')
                ->setLabel('pqr')
                ->setDescription('stu')
                ->setMode('vwx')
                ->setCraftingTime(4.2);

        $result = new RecipeDetailsResponse();
        $result->setRecipes([$recipe1, $recipe2]);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'recipes' => [
                [
                    'name' => 'abc',
                    'label' => 'def',
                    'description' => 'ghi',
                    'mode' => 'jkl',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 13.37,
                ],
                [
                    'name' => 'mno',
                    'label' => 'pqr',
                    'description' => 'stu',
                    'mode' => 'vwx',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 4.2,
                ],
            ],
        ];
    }
}
