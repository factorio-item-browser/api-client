<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the recipe details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsResponse implements ResponseInterface
{
    /**
     * The recipes details.
     * @var array|RecipeWithExpensiveVersion[]
     */
    protected $recipes = [];

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
}
