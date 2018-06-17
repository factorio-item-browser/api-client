<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Entity\Item;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the item product request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductResponse extends AbstractResponse
{
    /**
     * The details of the requested item.
     * @var Item
     */
    protected $item;

    /**
     * The recipes having the item as product, grouped by name.
     * @var array|GenericEntityWithRecipes[]
     */
    protected $groupedRecipes;

    /**
     * The total number of available results.
     * @var int
     */
    protected $totalNumberOfResults;

    /**
     * Returns the details of the requested item.
     * @return Item
     * @throws ApiClientException
     */
    public function getItem(): Item
    {
        $this->checkPendingResponse();
        return $this->item;
    }

    /**
     * Returns the recipes having the item as product, grouped by name.
     * @return array|GenericEntityWithRecipes[]
     * @throws ApiClientException
     */
    public function getGroupedRecipes(): array
    {
        $this->checkPendingResponse();
        return $this->groupedRecipes;
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
        $this->item = (new Item())->readData($responseData->getObject('item'));
        $this->totalNumberOfResults = $responseData->getInteger('totalNumberOfResults');

        $this->groupedRecipes = [];
        foreach ($responseData->getObjectArray('groupedRecipes') as $groupedRecipeData) {
            $this->groupedRecipes[] = (new GenericEntityWithRecipes())->readData($groupedRecipeData);
        }
        return $this;
    }
}
