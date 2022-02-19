<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Transfer\Entity;
use JMS\Serializer\Annotation\Type;

/**
 * The request of the recipe details.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsRequest extends AbstractRequest
{
    /**
     * The internal types and names of the recipes to return the details of.
     * @var array<Entity>
     */
    #[Type('array<' . Entity::class . '>')]
    public array $recipes = [];

    /**
     * The internal names of the recipe to return the details of.
     * @var array<string>
     * @deprecated
     */
    #[Type('array<string>')]
    public array $names = [];
}
