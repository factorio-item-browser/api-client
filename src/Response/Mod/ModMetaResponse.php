<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the mod meta request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModMetaResponse implements ResponseInterface
{
    /**
     * The number of mods available in the browser.
     * @var int
     */
    protected $numberOfAvailableMods = 0;

    /**
     * The number of currently enabled mods.
     * @var int
     */
    protected $numberOfEnabledMods = 0;

    /**
     * Sets the number of mods available in the browser.
     * @param int $numberOfAvailableMods
     * @return $this
     */
    public function setNumberOfAvailableMods(int $numberOfAvailableMods): self
    {
        $this->numberOfAvailableMods = $numberOfAvailableMods;
        return $this;
    }

    /**
     * Returns the number of mods available in the browser.
     * @return int
     */
    public function getNumberOfAvailableMods(): int
    {
        return $this->numberOfAvailableMods;
    }

    /**
     * Sets the number of currently enabled mods.
     * @param int $numberOfEnabledMods
     * @return $this
     */
    public function setNumberOfEnabledMods(int $numberOfEnabledMods): self
    {
        $this->numberOfEnabledMods = $numberOfEnabledMods;
        return $this;
    }

    /**
     * Returns the number of currently enabled mods.
     * @return int
     */
    public function getNumberOfEnabledMods(): int
    {
        return $this->numberOfEnabledMods;
    }
}
