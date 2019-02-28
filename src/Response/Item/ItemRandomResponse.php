<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the item random request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomResponse implements ResponseInterface
{
    /**
     * The random items.
     * @var array|GenericEntityWithRecipes[]
     */
    protected $items = [];

    /**
     * Sets the random items.
     * @param array|GenericEntityWithRecipes[] $items
     * @return $this
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Adds a random item.
     * @param GenericEntityWithRecipes $item
     * @return $this
     */
    public function addItem(GenericEntityWithRecipes $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Returns the random items.
     * @return array|GenericEntityWithRecipes[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
