<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ItemListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ItemListResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $entity1 = new GenericEntityWithRecipes();
        $entity1->setType('abc')
                ->setName('def')
                ->setLabel('ghi')
                ->setDescription('jkl')
                ->setTotalNumberOfRecipes(42);

        $entity2 = new GenericEntityWithRecipes();
        $entity2->setType('mno')
                ->setName('pqr')
                ->setLabel('stu')
                ->setDescription('vwx')
                ->setTotalNumberOfRecipes(21);

        $result = new ItemListResponse();
        $result->setItems([$entity1, $entity2])
               ->setTotalNumberOfResults(1337);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'items' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'label' => 'ghi',
                    'description' => 'jkl',
                    'recipes' => [],
                    'totalNumberOfRecipes' => 42,
                ],
                [
                    'type' => 'mno',
                    'name' => 'pqr',
                    'label' => 'stu',
                    'description' => 'vwx',
                    'recipes' => [],
                    'totalNumberOfRecipes' => 21,
                ],
            ],
            'totalNumberOfResults' => 1337,
        ];
    }
}
