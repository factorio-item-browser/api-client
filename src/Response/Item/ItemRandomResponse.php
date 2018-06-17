<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;

/**
 * The response of the item random request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomResponse extends AbstractResponse
{
    /**
     * The random items.
     * @var array|GenericEntityWithRecipes
     */
    protected $items;

    /**
     * Returns the random items.
     * @return array|GenericEntityWithRecipes
     * @throws ApiClientException
     */
    public function getItems()
    {
        $this->checkPendingResponse();
        return $this->items;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        $this->items = [];
        foreach ($responseData->getObjectArray('items') as $itemData) {
            $this->items[] = (new GenericEntityWithRecipes())->readData($itemData);
        }
        return $this;
    }
}
