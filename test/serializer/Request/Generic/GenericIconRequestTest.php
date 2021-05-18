<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Transfer\Entity;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the GenericIconRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconRequestTest extends SerializerTestCase
{
    public function test(): void
    {
        $entity1 = new Entity();
        $entity1->type = 'abc';
        $entity1->name = 'def';

        $entity2 = new Entity();
        $entity2->type = 'ghi';
        $entity2->name = 'jkl';

        $object = new GenericIconRequest();
        $object->entities = [$entity1, $entity2];

        $data = [
            'entities' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                ],
                [
                    'type' => 'ghi',
                    'name' => 'jkl',
                ],
            ],
        ];

        $this->assertSerialization($data, $object);
        $this->assertDeserialization($object, $data);
    }
}
