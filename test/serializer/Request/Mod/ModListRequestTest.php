<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Mod;

use FactorioItemBrowser\Api\Client\Request\Mod\ModListRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ModListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $object = new ModListRequest();
        $object->indexOfFirstResult = 42;
        $object->numberOfResults = 1337;

        $data = [
            'indexOfFirstResult' => 42,
            'numberOfResults' => 1337,
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
