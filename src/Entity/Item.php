<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

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
    public function setAmount(float $amount)
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

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return array_merge(parent::writeData(), [
            'amount' => $this->amount
        ]);
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        parent::readData($data);
        $this->amount = $data->getFloat('amount');
        return $this;
    }
}