<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

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
    public array $entities = [];

    /**
     * The contents of the icon file.
     * @var string
     */
    public string $content = '';

    /**
     * The size of the icon.
     * @var int
     */
    public int $size = 0;
}
