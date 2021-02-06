<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

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
    protected function getObject(): object
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

        $object = new RecipeWithExpensiveVersion();
        $object->name = 'ijk';
        $object->label = 'lmn';
        $object->description = 'opq';
        $object->mode = 'rst';
        $object->ingredients = [$ingredient2];
        $object->products = [$product2];
        $object->craftingTime = 73.31;
        $object->expensiveVersion = $expensiveRecipe;

        return $object;
    }

    protected function getData(): array
    {
        return [
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
        ];
    }
}
