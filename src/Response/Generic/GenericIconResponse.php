<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Transfer\Icon;

/**
 * The response of the generic icon request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconResponse
{
    /**
     * The icons of the entities.
     * @var array<Icon>
     */
    public array $icons = [];
}
