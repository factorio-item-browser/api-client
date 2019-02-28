<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowser\Api\Client\Response\ResponseInterface;

/**
 * The response of the generic details request.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericDetailsResponse implements ResponseInterface
{
    /**
     * The entity details.
     * @var array|GenericEntity[]
     */
    protected $entities = [];

    /**
     * Sets the entity details.
     * @param array|GenericEntity[] $entities
     * @return $this
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Adds entity details.
     * @param GenericEntity $entity
     * @return $this
     */
    public function addEntity(GenericEntity $entity): self
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Returns the entity details.
     * @return array|GenericEntity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
