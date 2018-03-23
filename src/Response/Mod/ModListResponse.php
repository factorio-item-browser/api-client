<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the mod list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListResponse extends AbstractResponse
{
    /**
     * The list of available mods.
     * @var array|Mod[]
     */
    protected $mods;

    /**
     * Returns the list of available mods.
     * @return array|Mod[]
     * @throws ApiClientException
     */
    public function getMods(): array
    {
        $this->checkResponse();
        return $this->mods;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->mods = [];
        foreach ($responseData->getObjectArray('mods') as $modData) {
            $this->mods[] = (new Mod())->readData($modData);
        }
        return $this;
    }
}