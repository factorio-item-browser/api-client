<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Search;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the search query request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryResponse implements ResponseInterface
{
    /**
     * The results of the search.
     * @var array|GenericEntityWithRecipes[]
     */
    protected $results = [];

    /**
     * The total number of results of the search.
     * @var int
     */
    protected $totalNumberOfResults = 0;

    /**
     * Sets the results of the search.
     * @param array|GenericEntityWithRecipes[] $results
     * @return $this
     */
    public function setResults(array $results): self
    {
        $this->results = $results;
        return $this;
    }

    /**
     * Adds a result of the search
     * @param GenericEntityWithRecipes $result
     * @return $this
     */
    public function addResult(GenericEntityWithRecipes $result): self
    {
        $this->results[] = $result;
        return $this;
    }

    /**
     * Returns the results of the search.
     * @return array|GenericEntityWithRecipes[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * Sets the total number of results of the search.
     * @param int $totalNumberOfResults
     * @return $this
     */
    public function setTotalNumberOfResults(int $totalNumberOfResults): self
    {
        $this->totalNumberOfResults = $totalNumberOfResults;
        return $this;
    }

    /**
     * Returns the total number of results of the search.
     * @return int
     */
    public function getTotalNumberOfResults(): int
    {
        return $this->totalNumberOfResults;
    }
}
