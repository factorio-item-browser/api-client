<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Entity;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Entity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EntityTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new Entity();
        $object->type = 'abc';
        $object->name = 'def';

        return $object;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
        ];
    }
}
