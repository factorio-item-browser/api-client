<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the item product request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductResponse implements ResponseInterface
{
    /**
     * The details of the requested item.
     * @var GenericEntityWithRecipes
     */
    protected $item;

    /**
     * Sets the details of the requested item.
     * @param GenericEntityWithRecipes $item
     * @return $this
     */
    public function setItem(GenericEntityWithRecipes $item): self
    {
        $this->item = $item;
        return $this;
    }

    /**
     * Returns the details of the requested item.
     * @return GenericEntityWithRecipes
     */
    public function getItem(): GenericEntityWithRecipes
    {
        return $this->item;
    }
}
