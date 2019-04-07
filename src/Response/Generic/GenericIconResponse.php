<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the generic icon request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconResponse implements ResponseInterface
{
    /**
     * The icons of the entities.
     * @var array|Icon[]
     */
    protected $icons = [];

    /**
     * Sets the icons of the entities.
     * @param array|Icon[] $icons
     * @return $this
     */
    public function setIcons(array $icons): self
    {
        $this->icons = $icons;
        return $this;
    }

    /**
     * Adds an icon of the entities.
     * @param Icon $icon
     * @return $this
     */
    public function addIcon(Icon $icon): self
    {
        $this->icons[] = $icon;
        return $this;
    }

    /**
     * Returns the icons of the entities.
     * @return array|Icon[]
     */
    public function getIcons(): array
    {
        return $this->icons;
    }
}
