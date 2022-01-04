<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request of recipes having an item as product.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemProductRequest extends AbstractRequest
{
    /**
     * The type of the item.
     */
    public string $type = '';

    /**
     * The name of the item.
     */
    public string $name = '';

    /**
     * The number of results to return.
     */
    public int $numberOfResults = 10;

    /**
     * The 0-based index of the first result to return.
     */
    public int $indexOfFirstResult = 0;
}
