<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Transfer\GenericEntity;

/**
 * The response of the generic details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsResponse
{
    /**
     * The entity details.
     * @var array<GenericEntity>
     */
    public array $entities = [];
}
