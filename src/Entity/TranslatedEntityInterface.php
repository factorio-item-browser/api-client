<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The interface for translated entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface TranslatedEntityInterface
{
    /**
     * Returns the type of the entity.
     * @return string
     */
    public function getType(): string;

    /**
     * Returns the name of the entity.
     * @return string
     */
    public function getName(): string;

    /**
     * Sets the translated label of the entity.
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label);

    /**
     * Sets the translated description of the entity.
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);
}