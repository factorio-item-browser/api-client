<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use FactorioItemBrowser\Common\Constant\EntityType;

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
     * @var string
     */
    protected $mode = '';

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
     * Returns the type of the entity.
     * @return string
     */
    public function getType(): string
    {
        return EntityType::RECIPE;
    }

    /**
     * Sets the mode of the recipe.
     * @param string $mode
     * @return $this Implementing fluent interface.
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Returns the mode of the recipe.
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * Sets the ingredients of the recipe.
     * @param array|Item[] $ingredients
     * @return $this Implementing fluent interface.
     */
    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * Adds an ingredient to the recipe.
     * @param Item $ingredient
     * @return $this
     */
    public function addIngredient(Item $ingredient): self
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
    public function setProducts(array $products): self
    {
        $this->products = $products;
        return $this;
    }

    /**
     * Adds a product to the recipe.
     * @param Item $product
     * @return $this
     */
    public function addProduct(Item $product): self
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
    public function setCraftingTime(float $craftingTime): self
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
}
