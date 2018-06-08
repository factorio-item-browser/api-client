<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;

/**
 * The entity representing an item file.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Icon implements EntityInterface
{
    /**
     * The entities using the icons.
     * @var array|IconEntity[]
     */
    protected $entities = [];

    /**
     * The base64 encoded contents of the icon file.
     * @var string
     */
    protected $content = '';

    /**
     * Sets the entities of the entity.
     * @param array|IconEntity[] $entities
     * @return $this Implementing fluent interface.
     */
    public function setEntities(array $entities)
    {
        $this->entities = array_values(array_filter($entities, function ($entity): bool {
            return $entity instanceof IconEntity;
        }));
        return $this;
    }

    /**
     * Adds a entity to the entity.
     * @param IconEntity $entity
     * @return $this
     */
    public function addEntity(IconEntity $entity)
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * Returns the entities of the entity.
     * @return array|IconEntity[]
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
    public function setContent(string $content)
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


    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        return [
            'entities' => array_map(function (IconEntity $entity): array {
                return $entity->writeData();
            }, $this->entities),
            'content' => $this->content
        ];
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->entities = [];
        foreach ($data->getObjectArray('entities') as $entityData) {
            $this->entities[] = (new IconEntity())->readData($entityData);
        }
        $this->content = $data->getString('content');
        return $this;
    }
}
