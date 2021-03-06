<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;

/**
 * The response of the item list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemListResponse
{
    /**
     * The items.
     * @var array<GenericEntityWithRecipes>
     */
    public array $items = [];

    /**
     * The total number of available results.
     * @var int
     */
    public int $totalNumberOfResults = 0;
}
