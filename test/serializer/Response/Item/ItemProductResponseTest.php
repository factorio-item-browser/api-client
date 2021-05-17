<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\Item\ItemProductResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemProductResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductResponseTest extends SerializerTestCase
{
    public function test(): void
    {
        $entity = new GenericEntityWithRecipes();
        $entity->type = 'abc';
        $entity->name = 'def';
        $entity->label = 'ghi';
        $entity->description = 'jkl';
        $entity->totalNumberOfRecipes = 42;

        $object = new ItemProductResponse();
        $object->item = $entity;

        $data = [
            'item' => [
                'type' => 'abc',
                'name' => 'def',
                'label' => 'ghi',
                'description' => 'jkl',
                'recipes' => [],
                'totalNumberOfRecipes' => 42,
            ],
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
