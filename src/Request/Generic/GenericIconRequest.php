<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Entity\Entity;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request of icons for entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconRequest implements RequestInterface
{
    /**
     * The entities to request the icon for.
     * @var array|Entity[]
     */
    protected $entities = [];

    /**
     * Sets the entities to request the icon for.
     * @param array|Entity[] $entities
     * @return $this
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Adds an entity to request the icon for.
     * @param Entity $entity
     * @return $this
     */
    public function addEntity(Entity $entity): self
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Returns the the entities to request the icon for.
     * @return array|Entity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
