<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemIngredientRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemIngredientRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemIngredientRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new ItemIngredientRequest();
        $object->type = 'abc';
        $object->name = 'def';
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 21;

        $data = [
            'type' => 'abc',
            'name' => 'def',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
