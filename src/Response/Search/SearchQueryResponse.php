<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Search;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;

/**
 * The response of the search query request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryResponse
{
    /**
     * The results of the search.
     * @var array<GenericEntityWithRecipes>
     */
    public array $results = [];

    /**
     * The total number of results of the search.
     * @var int
     */
    public int $totalNumberOfResults = 0;
}
