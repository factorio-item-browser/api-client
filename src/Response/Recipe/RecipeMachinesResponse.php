<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Recipe;

use FactorioItemBrowser\Api\Client\Transfer\Machine;
use JMS\Serializer\Annotation\Type;

/**
 * The response of the recipe machines request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMachinesResponse
{
    /**
     * The machines able to craft the recipe.
     * @var array<Machine>
     */
    #[Type('array<' . Machine::class . '>')]
    public array $machines = [];

    /**
     * The total number of available results.
     */
    public int $totalNumberOfResults = 0;
}
