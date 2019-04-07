<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

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
     * @var Recipe|null
     */
    protected $expensiveVersion;

    /**
     * Sets the expensive version of the recipe, if available.
     * @param Recipe|null $expensiveVersion
     * @return $this
     */
    public function setExpensiveVersion(?Recipe $expensiveVersion): self
    {
        $this->expensiveVersion = $expensiveVersion;
        return $this;
    }

    /**
     * Returns whether an expensive version of the recipe is available.
     * @return bool
     */
    public function hasExpensiveVersion(): bool
    {
        return $this->expensiveVersion instanceof Recipe;
    }

    /**
     * Returns the expensive version of the recipe, if available.
     * @return Recipe|null
     */
    public function getExpensiveVersion(): ?Recipe
    {
        return $this->expensiveVersion;
    }
}
