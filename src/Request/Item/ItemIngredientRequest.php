<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\Item\ItemIngredientResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * The request of recipes using an item as ingredient.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemIngredientRequest implements RequestInterface
{
    /**
     * The type of the item.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the item.
     * @var string
     */
    protected $name = '';

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
     * Sets the type of the item.
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets the name of the item.
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
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
     * Returns the path of the request, relative to the API URL.
     * @return string
     */
    public function getRequestPath(): string
    {
        return '/item/ingredient';
    }

    /**
     * Returns the actual data of the request.
     * @return array
     */
    public function getRequestData(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'numberOfResults' => $this->numberOfResults,
            'indexOfFirstResult' => $this->indexOfFirstResult
        ];
    }

    /**
     * Creates the response instance matching the request.
     * @param PendingResponse $pendingResponse
     * @return AbstractResponse
     */
    public function createResponse(PendingResponse $pendingResponse): AbstractResponse
    {
        return new ItemIngredientResponse($pendingResponse);
    }
}