<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Item;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request of random items.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemRandomRequest extends AbstractRequest
{
    /**
     * The number of results to return.
     * @var int
     */
    public int $numberOfResults = 10;

    /**
     * The number of recipes to return for each result.
     * @var int
     */
    public int $numberOfRecipesPerResult = 3;
}
