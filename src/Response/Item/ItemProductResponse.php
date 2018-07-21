<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntityWithRecipes;
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
     * @var GenericEntityWithRecipes
     */
    protected $item;

    /**
     * Returns the details of the requested item.
     * @return GenericEntityWithRecipes
     * @throws ApiClientException
     */
    public function getItem(): GenericEntityWithRecipes
    {
        $this->checkPendingResponse();
        return $this->item;
    }

    /**
     * Maps the response data.
     * @param DataContainer $responseData
     * @return $this
     */
    protected function mapResponse(DataContainer $responseData)
    {
        $this->item = (new GenericEntityWithRecipes())->readData($responseData->getObject('item'));
        return $this;
    }
}
