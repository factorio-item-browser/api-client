<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic entity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\GenericEntity
 */
class GenericEntityTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $entity = new GenericEntity();
        $this->assertEquals('', $entity->getType());
        $this->assertEquals('', $entity->getName());
        $this->assertEquals('', $entity->getLabel());
        $this->assertEquals('', $entity->getDescription());
    }

    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType()
    {
        $entity = new GenericEntity();
        $this->assertEquals($entity, $entity->setType('abc'));
        $this->assertEquals('abc', $entity->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $entity = new GenericEntity();
        $this->assertEquals($entity, $entity->setName('abc'));
        $this->assertEquals('abc', $entity->getName());
    }

    /**
     * Tests setting and getting the label.
     * @covers ::setLabel
     * @covers ::getLabel
     */
    public function testSetAndGetLabel()
    {
        $entity = new GenericEntity();
        $this->assertEquals($entity, $entity->setLabel('abc'));
        $this->assertEquals('abc', $entity->getLabel());
    }

    /**
     * Tests setting and getting the description.
     * @covers ::setDescription
     * @covers ::getDescription
     */
    public function testSetAndGetDescription()
    {
        $entity = new GenericEntity();
        $this->assertEquals($entity, $entity->setDescription('abc'));
        $this->assertEquals('abc', $entity->getDescription());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $entity = new GenericEntity();
        $entity->setType('abc')
            ->setName('def')
            ->setLabel('ghi')
            ->setDescription('jkl');

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
            'label' => 'ghi',
            'description' => 'jkl',
        ];

        $data = $entity->writeData();
        $this->assertEquals($expectedData, $data);

        $newEntity = new GenericEntity();
        $this->assertEquals($newEntity, $newEntity->readData(new DataContainer($data)));
        $this->assertEquals($newEntity, $entity);
    }
}
