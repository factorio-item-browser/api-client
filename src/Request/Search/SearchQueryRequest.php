<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Search;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;
use FactorioItemBrowser\Api\Client\Response\Search\SearchQueryResponse;

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
     * The number pf recipes to return for each result.
     * @var int
     */
    protected $numberOfRecipesPerResult = 3;

    /**
     * Sets the query to search for.
     * @param string $query
     * @return $this
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Sets the number of results to return.
     * @param int $numberOfResults
     * @return $this
     */
    public function setNumberOfResults(int $numberOfResults)
    {
        $this->numberOfResults = $numberOfResults;
        return $this;
    }

    /**
     * Sets the 0-based index of the first result to return.
     * @param int $indexOfFirstResult
     * @return $this
     */
    public function setIndexOfFirstResult(int $indexOfFirstResult)
    {
        $this->indexOfFirstResult = $indexOfFirstResult;
        return $this;
    }

    /**
     * Sets the number pf recipes to return for each result.
     * @param int $numberOfRecipesPerResult
     * @return $this
     */
    public function setNumberOfRecipesPerResult(int $numberOfRecipesPerResult)
    {
        $this->numberOfRecipesPerResult = $numberOfRecipesPerResult;
        return $this;
    }

    /**
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string
    {
        return '/search/query';
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'query' => $this->query,
            'numberOfResults' => $this->numberOfResults,
            'indexOfFirstResult' => $this->indexOfFirstResult,
            'numberOfRecipesPerResult' => $this->numberOfRecipesPerResult
        ];
    }

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse
    {
        return new SearchQueryResponse($pendingResponse);
    }
}