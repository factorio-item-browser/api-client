<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Entity\Recipe;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the Recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class RecipeTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $ingredient1 = new Item();
        $ingredient1->setType('abc')
                    ->setName('def')
                    ->setLabel('ghi')
                    ->setDescription('jkl')
                    ->setAmount(1.2);

        $ingredient2 = new Item();
        $ingredient2->setType('mno')
                    ->setName('pqr')
                    ->setLabel('stu')
                    ->setDescription('vwx')
                    ->setAmount(2.3);

        $product1 = new Item();
        $product1->setType('yza')
                 ->setName('bcd')
                 ->setLabel('efg')
                 ->setDescription('hij')
                 ->setAmount(3.4);

        $product2 = new Item();
        $product2->setType('klm')
                 ->setName('nop')
                 ->setLabel('qrs')
                 ->setDescription('tuv')
                 ->setAmount(4.5);

        $result = new Recipe();
        $result->setName('wxy')
               ->setLabel('zab')
               ->setDescription('cde')
               ->setMode('fgh')
               ->setIngredients([$ingredient1, $ingredient2])
               ->setProducts([$product1, $product2])
               ->setCraftingTime(13.37);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'name' => 'wxy',
            'label'=> 'zab',
            'description' => 'cde',
            'mode' => 'fgh',
            'ingredients' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'label'=> 'ghi',
                    'description' => 'jkl',
                    'amount' => 1.2,
                ],
                [
                    'type' => 'mno',
                    'name' => 'pqr',
                    'label'=> 'stu',
                    'description' => 'vwx',
                    'amount' => 2.3,
                ],
            ],
            'products' => [
                [
                    'type' => 'yza',
                    'name' => 'bcd',
                    'label'=> 'efg',
                    'description' => 'hij',
                    'amount' => 3.4,
                ],
                [
                    'type' => 'klm',
                    'name' => 'nop',
                    'label'=> 'qrs',
                    'description' => 'tuv',
                    'amount' => 4.5,
                ],
            ],
            'craftingTime' => 13.37,
        ];
    }
}
