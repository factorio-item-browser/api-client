<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Transfer;

use FactorioItemBrowser\Api\Client\Transfer\Item;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the Item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new Item();
        $object->type = 'abc';
        $object->name = 'def';
        $object->label = 'ghi';
        $object->description = 'jkl';
        $object->amount = 13.37;
        return $object;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
            'amount' => 13.37,
        ];
    }
}
