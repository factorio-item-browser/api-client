<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

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
     */
    public float $amount = 0.;
}
