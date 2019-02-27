<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Entity\RequestEntity;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;

/**
 * The request of generic details of entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsRequest implements RequestInterface
{
    /**
     * The entities to request the details for.
     * @var array|RequestEntity[]
     */
    protected $entities = [];

    /**
     * Sets the entities to request the details for.
     * @param array|RequestEntity[] $entities
     * @return $this
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Adds an entity to request the details for.
     * @param RequestEntity $entity
     * @return $this
     */
    public function addEntity(RequestEntity $entity): self
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Returns the the entities to request the details for.
     * @return array|RequestEntity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
