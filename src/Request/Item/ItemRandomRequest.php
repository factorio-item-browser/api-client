<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\Item\ItemRandomResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * The request of random items.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomRequest implements RequestInterface
{
    /**
     * The number of results to return.
     * @var int
     */
    protected $numberOfResults = 10;

    /**
     * The number of recipes to return for each result.
     * @var int
     */
    protected $numberOfRecipesPerResult = 3;

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
     * Sets the number of recipes to return for each result.
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
        return '/item/random';
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'numberOfResults' => $this->numberOfResults,
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
        return new ItemRandomResponse($pendingResponse);
    }
}