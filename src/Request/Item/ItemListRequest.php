<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request of the item list.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemListRequest extends AbstractRequest
{
    /**
     * The number of results to return.
     */
    public int $numberOfResults = 10;

    /**
     * The 0-based index of the first result to return.
     */
    public int $indexOfFirstResult = 0;

    /**
     * The number of recipes to return for each result.
     */
    public int $numberOfRecipesPerResult = 3;
}
