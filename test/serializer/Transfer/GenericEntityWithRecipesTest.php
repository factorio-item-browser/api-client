<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Transfer\Item;
use FactorioItemBrowser\Api\Client\Transfer\Recipe;
use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the GenericEntityWithRecipes class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericEntityWithRecipesTest extends SerializerTestCase
{
    public function test(): void
    {
        $ingredient1 = new Item();
        $ingredient1->type = 'abc';
        $ingredient1->name = 'def';
        $ingredient1->label = 'ghi';
        $ingredient1->description = 'jkl';
        $ingredient1->amount = 1.2;

        $ingredient2 = new Item();
        $ingredient2->type = 'mno';
        $ingredient2->name = 'pqr';
        $ingredient2->label = 'stu';
        $ingredient2->description = 'vwx';
        $ingredient2->amount = 2.3;

        $product1 = new Item();
        $product1->type = 'yza';
        $product1->name = 'bcd';
        $product1->label = 'efg';
        $product1->description = 'hij';
        $product1->amount = 3.4;

        $product2 = new Item();
        $product2->type = 'klm';
        $product2->name = 'nop';
        $product2->label = 'qrs';
        $product2->description = 'tuv';
        $product2->amount = 4.5;

        $expensiveRecipe = new Recipe();
        $expensiveRecipe->name = 'wxy';
        $expensiveRecipe->label = 'zab';
        $expensiveRecipe->description = 'cde';
        $expensiveRecipe->mode = 'fgh';
        $expensiveRecipe->ingredients = [$ingredient1];
        $expensiveRecipe->products = [$product1];
        $expensiveRecipe->craftingTime = 13.37;

        $recipe = new RecipeWithExpensiveVersion();
        $recipe->name = 'ijk';
        $recipe->label = 'lmn';
        $recipe->description = 'opq';
        $recipe->mode = 'rst';
        $recipe->ingredients = [$ingredient2];
        $recipe->products = [$product2];
        $recipe->craftingTime = 73.31;
        $recipe->expensiveVersion = $expensiveRecipe;

        $object = new GenericEntityWithRecipes();
        $object->type = 'uvw';
        $object->name = 'xyz';
        $object->label = 'cba';
        $object->description = 'fed';
        $object->recipes = [$recipe];
        $object->totalNumberOfRecipes = 42;

        $data = [
            'type' => 'uvw',
            'name' => 'xyz',
            'label' => 'cba',
            'description' => 'fed',
            'recipes' => [
                [
                    'name' => 'ijk',
                    'label' => 'lmn',
                    'description' => 'opq',
                    'mode' => 'rst',
                    'ingredients' => [
                        [
                            'type' => 'mno',
                            'name' => 'pqr',
                            'label' => 'stu',
                            'description' => 'vwx',
                            'amount' => 2.3,
                        ],
                    ],
                    'products' => [
                        [
                            'type' => 'klm',
                            'name' => 'nop',
                            'label' => 'qrs',
                            'description' => 'tuv',
                            'amount' => 4.5,
                        ],
                    ],
                    'craftingTime' => 73.31,
                    'expensiveVersion' => [
                        'name' => 'wxy',
                        'label' => 'zab',
                        'description' => 'cde',
                        'mode' => 'fgh',
                        'ingredients' => [
                            [
                                'type' => 'abc',
                                'name' => 'def',
                                'label' => 'ghi',
                                'description' => 'jkl',
                                'amount' => 1.2,
                            ],
                        ],
                        'products' => [
                            [
                                'type' => 'yza',
                                'name' => 'bcd',
                                'label' => 'efg',
                                'description' => 'hij',
                                'amount' => 3.4,
                            ],
                        ],
                        'craftingTime' => 13.37,
                    ],
                ],
            ],
            'totalNumberOfRecipes' => 42,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
