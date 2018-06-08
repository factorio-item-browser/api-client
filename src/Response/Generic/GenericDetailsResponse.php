<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the generic details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsResponse extends AbstractResponse
{
    /**
     * The entity details.
     * @var array|GenericEntity[]
     */
    protected $entities;

    /**
     * Returns the entity details.
     * @return array|GenericEntity[]
     * @throws ApiClientException
     */
    public function getEntities(): array
    {
        $this->checkPendingResponse();
        return $this->entities;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->entities = [];
        foreach ($responseData->getObjectArray('entities') as $entityData) {
            $this->entities[] = (new GenericEntity())->readData($entityData);
        }
        return $this;
    }
}
