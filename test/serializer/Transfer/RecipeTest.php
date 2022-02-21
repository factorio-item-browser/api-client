<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Category;
use FactorioItemBrowser\Api\Client\Transfer\Item;
use FactorioItemBrowser\Api\Client\Transfer\Recipe;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeTest extends SerializerTestCase
{
    public function test(): void
    {
        $category = new Category();
        $category->type = 'ijk';
        $category->name = 'lmn';

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

        $object = new Recipe();
        $object->type = 'ijk';
        $object->name = 'wxy';
        $object->label = 'zab';
        $object->description = 'cde';
        $object->mode = 'fgh';
        $object->category = $category;
        $object->ingredients = [$ingredient1, $ingredient2];
        $object->products = [$product1, $product2];
        $object->time = 13.37;

        $data = [
            'type' => 'ijk',
            'name' => 'wxy',
            'label' => 'zab',
            'description' => 'cde',
            'mode' => 'fgh',
            'category' => [
                'type' => 'ijk',
                'name' => 'lmn',
            ],
            'ingredients' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'label' => 'ghi',
                    'description' => 'jkl',
                    'amount' => 1.2,
                ],
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
                    'type' => 'yza',
                    'name' => 'bcd',
                    'label' => 'efg',
                    'description' => 'hij',
                    'amount' => 3.4,
                ],
                [
                    'type' => 'klm',
                    'name' => 'nop',
                    'label' => 'qrs',
                    'description' => 'tuv',
                    'amount' => 4.5,
                ],
            ],
            'time' => 13.37,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
