<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

/**
 * The class representing an entity without any additional data.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Entity
{
    /**
     * The type of the entity.
     */
    public string $type = '';

    /**
     * The name of the entity.
     */
    public string $name = '';
}
