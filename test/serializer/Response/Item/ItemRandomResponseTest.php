<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemRandomResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomResponseTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $entity1 = new GenericEntityWithRecipes();
        $entity1->type = 'abc';
        $entity1->name = 'def';
        $entity1->label = 'ghi';
        $entity1->description = 'jkl';
        $entity1->totalNumberOfRecipes = 42;

        $entity2 = new GenericEntityWithRecipes();
        $entity2->type = 'mno';
        $entity2->name = 'pqr';
        $entity2->label = 'stu';
        $entity2->description = 'vwx';
        $entity2->totalNumberOfRecipes = 21;

        $object = new ItemRandomResponse();
        $object->items = [$entity1, $entity2];

        return $object;
    }

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
        ];
    }
}
