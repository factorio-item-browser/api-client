<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

/**
 * The class representing a generic entity containing recipes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericEntityWithRecipes extends GenericEntity
{
    /**
     * The recipes of the entity.
     * @var array<RecipeWithExpensiveVersion>
     */
    public array $recipes = [];

    /**
     * The total number of recipes available for this entity.
     * @var int
     */
    public int $totalNumberOfRecipes = 0;
}
