<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ValidatedMod;

/**
 * The response of the combination validate request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class CombinationValidateResponse
{
    /**
     * Whether the combination of mods is valid.
     * @var bool
     */
    protected $isValid = false;

    /**
     * The list of validated mods.
     * @var array<ValidatedMod>|ValidatedMod[]
     */
    protected $validatedMods = [];

    /**
     * Sets whether the combination of mods is valid.
     * @param bool $isValid
     * @return $this
     */
    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * Returns whether the combination of mods is valid.
     * @return bool
     */
    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Sets the list of validated mods.
     * @param array|ValidatedMod[] $validatedMods
     * @return $this
     */
    public function setValidatedMods(array $validatedMods): self
    {
        $this->validatedMods = $validatedMods;
        return $this;
    }

    /**
     * Adds a validated mod to the list.
     * @param ValidatedMod $validatedMod
     * @return $this
     */
    public function addValidatedMod(ValidatedMod $validatedMod): self
    {
        $this->validatedMods[] = $validatedMod;
        return $this;
    }

    /**
     * Returns the list of validated mods.
     * @return array|ValidatedMod[]
     */
    public function getValidatedMods(): array
    {
        return $this->validatedMods;
    }
}
