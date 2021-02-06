<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the ItemListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemListRequestTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new ItemListRequest();
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 1337;
        $object->numberOfRecipesPerResult = 21;

        return $object;
    }

    protected function getData(): array
    {
        return [
            'numberOfResults' => 42,
            'indexOfFirstResult' => 1337,
            'numberOfRecipesPerResult' => 21,
        ];
    }
}
