<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the recipe list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeListResponse implements ResponseInterface
{
    /**
     * The recipes.
     * @var array|RecipeWithExpensiveVersion[]
     */
    protected $recipes = [];

    /**
     * The total number of available results.
     * @var int
     */
    protected $totalNumberOfResults = 0;

    /**
     * Sets the recipes details.
     * @param array|RecipeWithExpensiveVersion[] $recipes
     * @return $this
     */
    public function setRecipes(array $recipes): self
    {
        $this->recipes = $recipes;
        return $this;
    }

    /**
     * Adds recipe details.
     * @param RecipeWithExpensiveVersion $recipe
     * @return $this
     */
    public function addRecipe(RecipeWithExpensiveVersion $recipe): self
    {
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Returns the recipes details.
     * @return array|RecipeWithExpensiveVersion[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }

    /**
     * Sets the total number of available results.
     * @param int $totalNumberOfResults
     * @return $this
     */
    public function setTotalNumberOfResults(int $totalNumberOfResults): self
    {
        $this->totalNumberOfResults = $totalNumberOfResults;
        return $this;
    }

    /**
     * Returns the total number of available results.
     * @return int
     */
    public function getTotalNumberOfResults(): int
    {
        return $this->totalNumberOfResults;
    }
}
