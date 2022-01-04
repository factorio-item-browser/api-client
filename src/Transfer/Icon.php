<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

use JMS\Serializer\Annotation\Type;

/**
 * The entity representing an icon file.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Icon
{
    /**
     * The entities using the icons.
     * @var array<Entity>
     */
    #[Type('array<' . Entity::class . '>')]
    public array $entities = [];

    /**
     * The contents of the icon file.
     */
    #[Type('base64')]
    public string $content = '';

    /**
     * The size of the icon.
     */
    public int $size = 0;
}
