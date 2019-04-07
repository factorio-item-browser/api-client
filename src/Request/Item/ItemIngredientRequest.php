<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;

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
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the the type of the item.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the item.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the the name of the item.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * Returns the the number of results to return.
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
     * Returns the the 0-based index of the first result to return.
     * @return int
     */
    public function getIndexOfFirstResult(): int
    {
        return $this->indexOfFirstResult;
    }
}
