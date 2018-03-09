<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

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
     * @var array|Recipe[]
     */
    protected $recipes = [];

    /**
     * The total number of recipes available for this entity.
     * @var int
     */
    protected $totalNumberOfRecipes = 0;

    /**
     * Sets the recipes of the entity.
     * @param array|Recipe[] $recipes
     * @return $this Implementing fluent interface.
     */
    public function setRecipes(array $recipes)
    {
        $this->recipes = array_values(array_filter($recipes, function ($recipe): bool {
            return $recipe instanceof Recipe;
        }));
        return $this;
    }

    /**
     * Adds a recipe to the entity.
     * @param Recipe $recipe
     * @return $this
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Returns the recipes of the entity.
     * @return array|Recipe[]
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
    public function setTotalNumberOfRecipes(int $totalNumberOfRecipes)
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

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $data = parent::writeData();
        $data['recipes'] = array_map(function (Recipe $recipe): array {
            return $recipe->writeData();
        }, $this->recipes);
        $data['totalNumberOfRecipes'] = $this->totalNumberOfRecipes;
        return $data;
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        parent::readData($data);
        $this->recipes = [];
        foreach ($data->getObjectArray('recipes') as $recipeData) {
            $this->recipes[] = (new Recipe())->readData($recipeData);
        }
        $this->totalNumberOfRecipes = $data->getInteger('totalNumberOfRecipes');
        return $this;
    }
}