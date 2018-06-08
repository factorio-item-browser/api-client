<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the mod meta request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModMetaResponse extends AbstractResponse
{
    /**
     * The number of mods available in the browser.
     * @var int
     */
    protected $numberOfAvailableMods;

    /**
     * The number of currently enabled mods.
     * @var int
     */
    protected $numberOfEnabledMods;

    /**
     * Returns the number of mods available in the browser.
     * @return int
     */
    public function getNumberOfAvailableMods(): int
    {
        $this->checkPendingResponse();
        return $this->numberOfAvailableMods;
    }

    /**
     * Returns the number of currently enabled mods.
     * @return int
     */
    public function getNumberOfEnabledMods(): int
    {
        $this->checkPendingResponse();
        return $this->numberOfEnabledMods;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->numberOfAvailableMods = $responseData->getInteger('numberOfAvailableMods');
        $this->numberOfEnabledMods = $responseData->getInteger('numberOfEnabledMods');
        return $this;
    }
}
