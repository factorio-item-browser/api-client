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
class EntityWithRecipes implements EntityInterface, TranslatedEntityInterface
{
    /**
     * The type of the entity.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the entity.
     * @var string
     */
    protected $name = '';

    /**
     * The translated label of the entity.
     * @var string
     */
    protected $label = '';

    /**
     * The translated description of the entity.
     * @var string
     */
    protected $description = '';

    /**
     * The recipes of the entity.
     * @var array|Recipe[]
     */
    protected $recipes = [];

    /**
     * Sets the type of the entity.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the entity.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the entity.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the entity.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the translated label of the entity.
     * @param string $label
     * @return $this Implementing fluent interface.
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Returns the translated label of the entity.
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Sets the translated description of the entity.
     * @param string $description
     * @return $this Implementing fluent interface.
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the translated description of the entity.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

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
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'label' => $this->label,
            'description' => $this->description,
            'recipes' => array_map(function (Recipe $recipe): array {
                return $recipe->writeData();
            }, $this->recipes)
        ];
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->type = $data->getString('type');
        $this->name = $data->getString('name');
        $this->label = $data->getString('label');
        $this->description = $data->getString('description');
        $this->recipes = [];
        foreach ($data->getObjectArray('recipes') as $recipeData) {
            $this->recipes[] = (new Recipe())->readData($recipeData);
        }
        return $this;
    }
}