<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntity;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the GenericEntity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericEntityTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new GenericEntity();
        $object->type = 'abc';
        $object->name = 'def';
        $object->label = 'ghi';
        $object->description = 'jkl';

        return $object;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
        ];
    }
}
