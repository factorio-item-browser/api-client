<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the generic icon request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconResponse extends AbstractResponse
{
    /**
     * The icons of the entities.
     * @var array|Icon[]
     */
    protected $icons;

    /**
     * Returns the icons of the entities.
     * @return array|Icon[]
     * @throws ApiClientException
     */
    public function getIcons(): array
    {
        $this->checkPendingResponse();
        return $this->icons;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->icons = [];
        foreach ($responseData->getObjectArray('icons') as $iconData) {
            $this->icons[] = (new Icon())->readData($iconData);
        }
        return $this;
    }
}