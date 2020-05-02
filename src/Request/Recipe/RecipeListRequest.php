<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request of the recipe list.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeListRequest implements RequestInterface
{
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
}
