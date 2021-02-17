<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;

/**
 * The response of the recipe list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeListResponse
{
    /**
     * The recipes.
     * @var array<RecipeWithExpensiveVersion>
     */
    public array $recipes = [];

    /**
     * The total number of available results.
     * @var int
     */
    public int $totalNumberOfResults = 0;
}
