<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use FactorioItemBrowser\Common\Constant\EntityType;

/**
 * The entity representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe extends GenericEntity
{
    public string $type = EntityType::RECIPE;

    /**
     * The mode of the recipe.
     * @var string
     */
    public string $mode = '';

    /**
     * The ingredients of the recipe.
     * @var array<Item>
     */
    public array $ingredients = [];

    /**
     * The products of the recipe.
     * @var array<Item>
     */
    public array $products = [];

    /**
     * The crafting time of the recipe.
     * @var float
     */
    public float $craftingTime = 0.;
}
