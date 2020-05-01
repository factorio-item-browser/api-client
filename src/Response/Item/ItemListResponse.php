<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the item list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemListResponse implements ResponseInterface
{
    /**
     * The items.
     * @var array|GenericEntityWithRecipes[]
     */
    protected $items = [];

    /**
     * The total number of available results.
     * @var int
     */
    protected $totalNumberOfResults = 0;

    /**
     * Sets the items.
     * @param array|GenericEntityWithRecipes[] $items
     * @return $this
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Adds a item.
     * @param GenericEntityWithRecipes $item
     * @return $this
     */
    public function addItem(GenericEntityWithRecipes $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Returns the items.
     * @return array|GenericEntityWithRecipes[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Sets the total number of available results.
     * @param int $totalNumberOfResults
     * @return $this
     */
    public function setTotalNumberOfResults(int $totalNumberOfResults): self
    {
        $this->totalNumberOfResults = $totalNumberOfResults;
        return $this;
    }

    /**
     * Returns the total number of available results.
     * @return int
     */
    public function getTotalNumberOfResults(): int
    {
        return $this->totalNumberOfResults;
    }
}
