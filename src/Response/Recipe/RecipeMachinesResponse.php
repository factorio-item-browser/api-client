<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the recipe machines request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesResponse implements ResponseInterface
{
    /**
     * The machines able to craft the recipe.
     * @var array|Machine[]
     */
    protected $machines = [];

    /**
     * The total number of available results.
     * @var int
     */
    protected $totalNumberOfResults = 0;

    /**
     * Sets the machines able to craft the recipe.
     * @param array|Machine[] $machines
     * @return $this
     */
    public function setMachines(array $machines): self
    {
        $this->machines = $machines;
        return $this;
    }

    /**
     * Adds a machine able to craft the recipe.
     * @param Machine $machine
     * @return $this
     */
    public function addMachine(Machine $machine): self
    {
        $this->machines[] = $machine;
        return $this;
    }

    /**
     * Returns the machines able to craft the recipe.
     * @return array|Machine[]
     */
    public function getMachines(): array
    {
        return $this->machines;
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
