<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the mod list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListResponse implements ResponseInterface
{
    /**
     * The list of available mods.
     * @var array|Mod[]
     */
    protected $mods = [];

    /**
     * Sets the list of available mods.
     * @param array|Mod[] $mods
     * @return $this
     */
    public function setMods(array $mods): self
    {
        $this->mods = $mods;
        return $this;
    }

    /**
     * Adds a mod to the list of available mods.
     * @param Mod $mod
     * @return $this
     */
    public function addMod(Mod $mod): self
    {
        $this->mods[] = $mod;
        return $this;
    }

    /**
     * Returns the list of available mods.
     * @return array|Mod[]
     */
    public function getMods(): array
    {
        return $this->mods;
    }
}
