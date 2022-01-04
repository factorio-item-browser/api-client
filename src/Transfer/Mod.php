<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use FactorioItemBrowser\Common\Constant\EntityType;

/**
 * The entity representing a mod.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Mod extends GenericEntity
{
    public string $type = EntityType::MOD;

    /**
     * The author of the mod.
     */
    public string $author = '';

    /**
     * The version of the mod.
     */
    public string $version = '';
}
