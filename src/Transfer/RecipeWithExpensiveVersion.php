<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

/**
 * The entity representing a recipe including its expensive version.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeWithExpensiveVersion extends Recipe
{
    /**
     * The expensive version of the recipe, if available.
     */
    public ?Recipe $expensiveVersion = null;
}
