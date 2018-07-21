<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Constant;

/**
 * The modes of the recipes.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeMode
{
    /**
     * The recipe is used in normal mode, or if no expensive version exists.
     */
    const NORMAL = 'normal';

    /**
     * The recipe is used in expensive mode.
     */
    const EXPENSIVE = 'expensive';
}
