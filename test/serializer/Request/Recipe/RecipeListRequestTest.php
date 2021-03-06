<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeListRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the RecipeListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeListRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new RecipeListRequest();
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 21;

        $data = [
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
