<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * The request of the recipe details.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsRequest extends AbstractRequest
{
    /**
     * The internal names of the recipe to return the details of.
     * @var array<string>
     */
    public array $names = [];
}
