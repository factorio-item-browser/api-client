<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

/**
 * The entity representing a recipe inluding its expensive version.
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
    public function setExpensiveVersion($expensiveVersion)
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
    public function getExpensiveVersion()
    {
        return $this->expensiveVersion;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $data = parent::writeData();
        if ($this->expensiveVersion instanceof Recipe) {
            $data['expensiveVersion'] = $this->expensiveVersion->writeData();
        }
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
        if (!is_null($data->get('expensiveVersion'))) {
            $this->expensiveVersion = (new Recipe())->readData($data->getObject('expensiveVersion'));
        }
        return $this;
    }
}
