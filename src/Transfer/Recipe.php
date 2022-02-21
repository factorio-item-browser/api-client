<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use FactorioItemBrowser\Common\Constant\EntityType;
use JMS\Serializer\Annotation\Type;

/**
 * The entity representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe extends GenericEntity
{
    /**
     * The mode of the recipe.
     */
    public string $mode = '';

    /**
     * The category of the recipe.
     */
    public ?Category $category = null;

    /**
     * The ingredients of the recipe.
     * @var array<Item>
     */
    #[Type('array<' . Item::class . '>')]
    public array $ingredients = [];

    /**
     * The products of the recipe.
     * @var array<Item>
     */
    #[Type('array<' . Item::class . '>')]
    public array $products = [];

    /**
     * The crafting or mining time of the recipe.
     */
    public float $time = 0.;
}
