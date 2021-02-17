<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request of the recipe machines.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesRequest extends AbstractRequest
{
    /**
     * The name of the recipe.
     * @var string
     */
    public string $name = '';

    /**
     * The number of results to return.
     * @var int
     */
    public int $numberOfResults = 10;

    /**
     * The 0-based index of the first result to return.
     * @var int
     */
    public int $indexOfFirstResult = 0;
}
