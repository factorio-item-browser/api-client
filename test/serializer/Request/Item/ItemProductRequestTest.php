<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemProductRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemProductRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductRequestTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new ItemProductRequest();
        $object->type = 'abc';
        $object->name = 'def';
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 21;

        return $object;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
        ];
    }
}
