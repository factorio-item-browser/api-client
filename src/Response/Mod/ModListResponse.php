<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Mod;

use FactorioItemBrowser\Api\Client\Transfer\Mod;
use JMS\Serializer\Annotation\Type;

/**
 * The response of the mod list request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ModListResponse
{
    /**
     * The list of available mods.
     * @var array<Mod>
     */
    #[Type('array<' . Mod::class . '>')]
    public array $mods = [];
}
