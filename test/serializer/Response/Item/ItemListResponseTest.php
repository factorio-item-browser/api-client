<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntity;
use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemListResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemListResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ItemListResponseTest extends SerializerTestCase
{
    public function test(): void
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

        $object = new ItemListResponse();
        $object->items = [$entity1, $entity2];
        $object->totalNumberOfResults = 1337;

        $data = [
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

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }

    /**
     * Tests the special case of the reduced response without recipes and totalNumberOfRecipes keys for the items.
     */
    public function testReducedVariant(): void
    {
        $entity1 = new GenericEntity();
        $entity1->type = 'abc';
        $entity1->name = 'def';
        $entity1->label = 'ghi';
        $entity1->description = 'jkl';

        $entity2 = new GenericEntity();
        $entity2->type = 'mno';
        $entity2->name = 'pqr';
        $entity2->label = 'stu';
        $entity2->description = 'vwx';

        $object = new ItemListResponse();
        // @phpstan-ignore-next-line
        $object->items = [$entity1, $entity2];
        $object->totalNumberOfResults = 1337;

        $data = [
            'items' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'label' => 'ghi',
                    'description' => 'jkl',
                ],
                [
                    'type' => 'mno',
                    'name' => 'pqr',
                    'label' => 'stu',
                    'description' => 'vwx',
                ],
            ],
            'totalNumberOfResults' => 1337,
        ];

        $this->assertSerialization($data, $object);
    }
}
