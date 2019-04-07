<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request for the search query.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryRequest implements RequestInterface
{
    /**
     * The query to search for.
     * @var string
     */
    protected $query = '';

    /**
     * The number of results to return.
     * @var int
     */
    protected $numberOfResults = 10;

    /**
     * The 0-based index of the first result to return.
     * @var int
     */
    protected $indexOfFirstResult = 0;

    /**
     * The number of recipes to return for each result.
     * @var int
     */
    protected $numberOfRecipesPerResult = 3;

    /**
     * Sets the query to search for.
     * @param string $query
     * @return $this
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Returns the query to search for.
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Sets the number of results to return.
     * @param int $numberOfResults
     * @return $this
     */
    public function setNumberOfResults(int $numberOfResults): self
    {
        $this->numberOfResults = $numberOfResults;
        return $this;
    }

    /**
     * Returns the number of results to return.
     * @return int
     */
    public function getNumberOfResults(): int
    {
        return $this->numberOfResults;
    }

    /**
     * Sets the 0-based index of the first result to return.
     * @param int $indexOfFirstResult
     * @return $this
     */
    public function setIndexOfFirstResult(int $indexOfFirstResult): self
    {
        $this->indexOfFirstResult = $indexOfFirstResult;
        return $this;
    }

    /**
     * Returns the 0-based index of the first result to return.
     * @return int
     */
    public function getIndexOfFirstResult(): int
    {
        return $this->indexOfFirstResult;
    }

    /**
     * Sets the number pf recipes to return for each result.
     * @param int $numberOfRecipesPerResult
     * @return $this
     */
    public function setNumberOfRecipesPerResult(int $numberOfRecipesPerResult): self
    {
        $this->numberOfRecipesPerResult = $numberOfRecipesPerResult;
        return $this;
    }

    /**
     * Returns the number of recipes to return for each result.
     * @return int
     */
    public function getNumberOfRecipesPerResult(): int
    {
        return $this->numberOfRecipesPerResult;
    }
}
