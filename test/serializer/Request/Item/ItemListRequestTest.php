<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\Item\ItemListRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ItemListRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ItemListRequestTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new ItemListRequest();
        $result->setNumberOfResults(42)
               ->setIndexOfFirstResult(1337)
               ->setNumberOfRecipesPerResult(21);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'numberOfResults' => 42,
            'indexOfFirstResult' => 1337,
            'numberOfRecipesPerResult' => 21,
        ];
    }
}
