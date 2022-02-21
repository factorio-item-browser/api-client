<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\Recipe\RecipeListResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeListResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $recipe1 = new RecipeWithExpensiveVersion();
        $recipe1->type = 'yza';
        $recipe1->name = 'abc';
        $recipe1->label = 'def';
        $recipe1->description = 'ghi';
        $recipe1->mode = 'jkl';
        $recipe1->time = 13.37;

        $recipe2 = new RecipeWithExpensiveVersion();
        $recipe2->type = 'bcd';
        $recipe2->name = 'mno';
        $recipe2->label = 'pqr';
        $recipe2->description = 'stu';
        $recipe2->mode = 'vwx';
        $recipe2->time = 4.2;

        $object = new RecipeListResponse();
        $object->recipes = [$recipe1, $recipe2];
        $object->totalNumberOfResults = 42;

        $data = [
            'recipes' => [
                [
                    'type' => 'yza',
                    'name' => 'abc',
                    'label' => 'def',
                    'description' => 'ghi',
                    'mode' => 'jkl',
                    'ingredients' => [],
                    'products' => [],
                    'time' => 13.37,
                ],
                [
                    'type' => 'bcd',
                    'name' => 'mno',
                    'label' => 'pqr',
                    'description' => 'stu',
                    'mode' => 'vwx',
                    'ingredients' => [],
                    'products' => [],
                    'time' => 4.2,
                ],
            ],
            'totalNumberOfResults' => 42,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
