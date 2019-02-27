<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

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
     * @var array|RecipeWithExpensiveVersion[]
     */
    protected $recipes = [];

    /**
     * The total number of recipes available for this entity.
     * @var int
     */
    protected $totalNumberOfRecipes = 0;

    /**
     * Sets the recipes of the entity.
     * @param array|RecipeWithExpensiveVersion[] $recipes
     * @return $this Implementing fluent interface.
     */
    public function setRecipes(array $recipes): self
    {
        $this->recipes = $recipes;
        return $this;
    }

    /**
     * Adds a recipe to the entity.
     * @param RecipeWithExpensiveVersion $recipe
     * @return $this
     */
    public function addRecipe(RecipeWithExpensiveVersion $recipe): self
    {
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Returns the recipes of the entity.
     * @return array|RecipeWithExpensiveVersion[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }

    /**
     * Sets the total number of recipes available for this entity.
     * @param int $totalNumberOfRecipes
     * @return $this
     */
    public function setTotalNumberOfRecipes(int $totalNumberOfRecipes): self
    {
        $this->totalNumberOfRecipes = $totalNumberOfRecipes;
        return $this;
    }

    /**
     * Returns the total number of recipes available for this entity.
     * @return int
     */
    public function getTotalNumberOfRecipes(): int
    {
        return $this->totalNumberOfRecipes;
    }
}
