<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Entity;
use FactorioItemBrowser\Api\Client\Transfer\Icon;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class IconTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $entity1 = new Entity();
        $entity1->type = 'abc';
        $entity1->name = 'def';

        $entity2 = new Entity();
        $entity2->type = 'ghi';
        $entity2->name = 'jkl';

        $object = new Icon();
        $object->entities = [$entity1, $entity2];
        $object->content = 'mno';
        $object->size = 42;

        return $object;
    }

    protected function getData(): array
    {
        return [
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
            'content' => 'bW5v',
            'size' => 42,
        ];
    }
}
