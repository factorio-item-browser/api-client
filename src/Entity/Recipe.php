<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The entity representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe implements TranslatedEntityInterface
{
    /**
     * The type of the recipe.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the recipe.
     * @var string
     */
    protected $name = '';

    /**
     * The translated label of the recipe.
     * @var string
     */
    protected $label = '';

    /**
     * The translated description of the recipe.
     * @var string
     */
    protected $description = '';

    /**
     * The ingredients of the recipe.
     * @var array|Item[]
     */
    protected $ingredients = [];

    /**
     * The products of the recipe.
     * @var array|Item[]
     */
    protected $products = [];

    /**
     * The crafting time of the recipe.
     * @var float
     */
    protected $craftingTime = 0.;

    /**
     * Sets the type of the recipe.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the recipe.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the recipe.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the recipe.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the translated label of the recipe.
     * @param string $label
     * @return $this Implementing fluent interface.
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Returns the translated label of the recipe.
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Sets the translated description of the recipe.
     * @param string $description
     * @return $this Implementing fluent interface.
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the translated description of the recipe.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the ingredients of the recipe.
     * @param array|Item[] $ingredients
     * @return $this Implementing fluent interface.
     */
    public function setIngredients(array $ingredients)
    {
        $this->ingredients = array_values(array_filter($ingredients, function ($ingredient): bool {
            return $ingredient instanceof Item;
        }));
        return $this;
    }

    /**
     * Adds an ingredient to the recipe.
     * @param Item $ingredient
     * @return $this
     */
    public function addIngredient(Item $ingredient)
    {
        $this->ingredients[] = $ingredient;
        return $this;
    }

    /**
     * Returns the ingredients of the recipe.
     * @return array|Item[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Sets the products of the recipe.
     * @param array|Item[] $products
     * @return $this Implementing fluent interface.
     */
    public function setProducts(array $products)
    {
        $this->products = array_values(array_filter($products, function ($product): bool {
            return $product instanceof Item;
        }));
        return $this;
    }

    /**
     * Adds a product to the recipe.
     * @param Item $product
     * @return $this
     */
    public function addProduct(Item $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * Returns the products of the recipe.
     * @return array|Item[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Sets the crafting time of the recipe.
     * @param float $craftingTime
     * @return $this Implementing fluent interface.
     */
    public function setCraftingTime(float $craftingTime)
    {
        $this->craftingTime = $craftingTime;
        return $this;
    }

    /**
     * Returns the crafting time of the recipe.
     * @return float
     */
    public function getCraftingTime(): float
    {
        return $this->craftingTime;
    }

    /**
     * Returns the translation type of the entity.
     * @return string
     */
    public function getTranslationType(): string
    {
        return 'recipe';
    }
}