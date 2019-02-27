<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The entity representing an actual item or fluid.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Item extends GenericEntity
{
    /**
     * The amount of the item as ingredient or product.
     * @var float
     */
    protected $amount = 0.;

    /**
     * Sets the amount of the item as ingredient or product.
     * @param float $amount
     * @return $this Implementing fluent interface.
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Returns the amount of the item as ingredient or product.
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
