<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The groups of the entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class EntityType
{
    /**
     * The item is an actual item you can hold in the hand. Theoretically.
     */
    const ITEM = 'item';

    /**
     * The item is actually a fluid. Or a gas.
     */
    const FLUID = 'fluid';

    /**
     * The entity is a machine. It is actually crafting a recipe.
     */
    const MACHINE = 'machine';

    /**
     * The entity is a recipe. It shows how to craft something into something else.
     */
    const RECIPE = 'recipe';
}