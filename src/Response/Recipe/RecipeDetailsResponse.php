<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use JMS\Serializer\Annotation\Type;

/**
 * The response of the recipe details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeDetailsResponse
{
    /**
     * The recipe details.
     * @var array<RecipeWithExpensiveVersion>
     */
    #[Type('array<' . RecipeWithExpensiveVersion::class . '>')]
    public array $recipes = [];
}
