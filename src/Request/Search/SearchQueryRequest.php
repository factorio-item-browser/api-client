<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request for the search query.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryRequest extends AbstractRequest
{
    /**
     * The query to search for.
     * @var string
     */
    public string $query = '';

    /**
     * The number of results to return.
     * @var int
     */
    public int $numberOfResults = 10;

    /**
     * The 0-based index of the first result to return.
     * @var int
     */
    public int $indexOfFirstResult = 0;

    /**
     * The number of recipes to return for each result.
     * @var int
     */
    public int $numberOfRecipesPerResult = 3;
}
