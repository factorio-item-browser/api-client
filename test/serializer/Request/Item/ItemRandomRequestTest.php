<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemRandomRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemRandomRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new ItemRandomRequest();
        $object->numberOfResults = 42;
        $object->numberOfRecipesPerResult = 21;

        $data = [
            'numberOfResults' => 42,
            'numberOfRecipesPerResult' => 21,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
