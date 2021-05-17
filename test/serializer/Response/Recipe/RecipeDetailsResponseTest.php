<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeDetailsResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeDetailsResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $recipe1 = new RecipeWithExpensiveVersion();
        $recipe1->name = 'abc';
        $recipe1->label = 'def';
        $recipe1->description = 'ghi';
        $recipe1->mode = 'jkl';
        $recipe1->craftingTime = 13.37;

        $recipe2 = new RecipeWithExpensiveVersion();
        $recipe2->name = 'mno';
        $recipe2->label = 'pqr';
        $recipe2->description = 'stu';
        $recipe2->mode = 'vwx';
        $recipe2->craftingTime = 4.2;

        $object = new RecipeDetailsResponse();
        $object->recipes = [$recipe1, $recipe2];

        $data = [
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

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
