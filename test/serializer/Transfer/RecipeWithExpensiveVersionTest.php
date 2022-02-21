<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Category;
use FactorioItemBrowser\Api\Client\Transfer\Item;
use FactorioItemBrowser\Api\Client\Transfer\Recipe;
use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeWithExpensiveVersion class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeWithExpensiveVersionTest extends SerializerTestCase
{
    public function test(): void
    {
        $category = new Category();
        $category->type = 'uvw';
        $category->name = 'xyz';

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
        $expensiveRecipe->type = 'uvw';
        $expensiveRecipe->name = 'wxy';
        $expensiveRecipe->label = 'zab';
        $expensiveRecipe->description = 'cde';
        $expensiveRecipe->mode = 'fgh';
        $expensiveRecipe->category = $category;
        $expensiveRecipe->ingredients = [$ingredient1];
        $expensiveRecipe->products = [$product1];
        $expensiveRecipe->time = 13.37;

        $object = new RecipeWithExpensiveVersion();
        $object->type = 'xyz';
        $object->name = 'ijk';
        $object->label = 'lmn';
        $object->description = 'opq';
        $object->mode = 'rst';
        $object->category = $category;
        $object->ingredients = [$ingredient2];
        $object->products = [$product2];
        $object->time = 73.31;
        $object->expensiveVersion = $expensiveRecipe;

        $data = [
            'type' => 'xyz',
            'name' => 'ijk',
            'label' => 'lmn',
            'description' => 'opq',
            'mode' => 'rst',
            'category' => [
                'type' => 'uvw',
                'name' => 'xyz',
            ],
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
            'time' => 73.31,
            'expensiveVersion' => [
                'type' => 'uvw',
                'name' => 'wxy',
                'label' => 'zab',
                'description' => 'cde',
                'mode' => 'fgh',
                'category' => [
                    'type' => 'uvw',
                    'name' => 'xyz',
                ],
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
                'time' => 13.37,
            ],
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
