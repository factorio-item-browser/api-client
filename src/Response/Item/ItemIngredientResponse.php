<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Item;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntityWithRecipes;

/**
 * The response of the item ingredient request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ItemIngredientResponse
{
    /**
     * The details of the requested item.
     */
    public GenericEntityWithRecipes $item;

    public function __construct()
    {
        $this->item = new GenericEntityWithRecipes();
    }
}
