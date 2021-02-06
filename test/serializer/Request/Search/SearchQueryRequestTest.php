<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The serializer test of the SearchQueryRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryRequestTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $object = new SearchQueryRequest();
        $object->query = 'abc';
        $object->numberOfResults = 42;
        $object->indexOfFirstResult = 21;
        $object->numberOfRecipesPerResult = 1337;

        return $object;
    }

    protected function getData(): array
    {
        return [
            'query' => 'abc',
            'numberOfResults' => 42,
            'indexOfFirstResult' => 21,
            'numberOfRecipesPerResult' => 1337,
        ];
    }
}
