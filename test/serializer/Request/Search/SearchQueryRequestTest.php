<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\Search\SearchQueryRequest;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the SearchQueryRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class SearchQueryRequestTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new SearchQueryRequest();
        $result->setQuery('abc')
               ->setNumberOfResults(42)
               ->setIndexOfFirstResult(21)
               ->setNumberOfRecipesPerResult(1337);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
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
