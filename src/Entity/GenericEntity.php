<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

/**
 * The class representing a generic entity holding basic information including translations.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericEntity extends Entity
{
    /**
     * The translated label of the entity.
     * @var string
     */
    protected $label = '';

    /**
     * The translated description of the entity.
     * @var string
     */
    protected $description = '';

    /**
     * Sets the translated label of the entity.
     * @param string $label
     * @return $this Implementing fluent interface.
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Returns the translated label of the entity.
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Sets the translated description of the entity.
     * @param string $description
     * @return $this Implementing fluent interface.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the translated description of the entity.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
