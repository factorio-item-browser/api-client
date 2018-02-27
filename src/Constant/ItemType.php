<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The types of the items.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemType
{
    /**
     * The item is an actual item you can hold in the hand. Theoretically.
     */
    const ITEM = 'item';

    /**
     * The item is actually a fluid. Or a gas.
     */
    const FLUID = 'fluid';
}