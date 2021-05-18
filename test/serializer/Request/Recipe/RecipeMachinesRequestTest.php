<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeMachinesRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeMachinesRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new RecipeMachinesRequest();
        $object->name = 'abc';
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 21;

        $data = [
            'name' => 'abc',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
