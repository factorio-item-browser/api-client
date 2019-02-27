<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

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
     * @var array|Entity[]
     */
    protected $entities = [];

    /**
     * The base64 encoded contents of the icon file.
     * @var string
     */
    protected $content = '';

    /**
     * Sets the entities of the entity.
     * @param array|Entity[] $entities
     * @return $this Implementing fluent interface.
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Adds a entity to the entity.
     * @param Entity $entity
     * @return $this
     */
    public function addEntity(Entity $entity): self
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Returns the entities of the entity.
     * @return array|Entity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
    
    /**
     * Sets the base64 encoded contents of the icon file.
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Returns the base64 encoded contents of the icon file.
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
