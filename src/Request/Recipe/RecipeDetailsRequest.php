<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request of the recipe details.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsRequest implements RequestInterface
{
    /**
     * The internal names of the recipe to return the details of.
     * @var array|string[]
     */
    protected $names = [];

    /**
     * Sets the internal names of the recipe to return the details of.
     * @param array|string[] $names
     * @return $this
     */
    public function setNames(array $names)
    {
        $this->names = $names;
        return $this;
    }

    /**
     * Adds an internal name of a recipe to return the details of.
     * @param string $name
     * @return $this
     */
    public function addName(string $name)
    {
        $this->names[] = $name;
        return $this;
    }

    /**
     * Returns the the internal names of the recipe to return the details of.
     * @return array|string[]
     */
    public function getNames()
    {
        return $this->names;
    }
}
