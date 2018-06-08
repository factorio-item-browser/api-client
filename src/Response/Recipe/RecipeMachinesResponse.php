<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Machine;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the recipe machines request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesResponse extends AbstractResponse
{
    /**
     * The machines able to craft the recipe.
     * @var array|Machine[]
     */
    protected $machines;

    /**
     * The total number of available results.
     * @var int
     */
    protected $totalNumberOfResults;

    /**
     * Returns the machines able to craft the recipe.
     * @return array|Machine[]
     */
    public function getMachines(): array
    {
        $this->checkPendingResponse();
        return $this->machines;
    }

    /**
     * Returns the total number of available results.
     * @return int
     * @throws ApiClientException
     */
    public function getTotalNumberOfResults(): int
    {
        $this->checkPendingResponse();
        return $this->totalNumberOfResults;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        parent::mapResponse($responseData);
        $this->machines = [];
        foreach ($responseData->getObjectArray('machines') as $machineData) {
            $this->machines[] = (new Machine())->readData($machineData);
        }
        $this->totalNumberOfResults = $responseData->getInteger('totalNumberOfResults');
        return $this;
    }
}