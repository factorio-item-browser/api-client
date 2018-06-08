<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Search;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the search query request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class SearchQueryResponse extends AbstractResponse
{
    /**
     * The results of the search.
     * @var array|GenericEntityWithRecipes[]
     */
    protected $results;

    /**
     * The total number of results of the search.
     * @var int
     */
    protected $totalNumberOfResults;

    /**
     * Returns the results of the search.
     * @return array|GenericEntityWithRecipes[]
     */
    public function getResults(): array
    {
        $this->checkPendingResponse();
        return $this->results;
    }

    /**
     * Returns the total number of results of the search.
     * @return int
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
        $this->results = [];
        foreach ($responseData->getObjectArray('results') as $resultData) {
            $this->results[] = (new GenericEntityWithRecipes())->readData($resultData);
        }
        $this->totalNumberOfResults = $responseData->getInteger('totalNumberOfResults');
        return $this;
    }
}
