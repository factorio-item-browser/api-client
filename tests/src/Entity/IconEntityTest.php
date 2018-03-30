<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\IconEntity;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the icon entity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\IconEntity
 */
class IconEntityTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $entity = new IconEntity();
        $this->assertEquals('', $entity->getType());
        $this->assertEquals('', $entity->getName());
    }

    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType()
    {
        $entity = new IconEntity();
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
        $entity = new IconEntity();
        $this->assertEquals($entity, $entity->setName('abc'));
        $this->assertEquals('abc', $entity->getName());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $entity = new IconEntity();
        $entity->setType('abc')
            ->setName('def');

        $expectedData = [
            'type' => 'abc',
            'name' => 'def',
        ];

        $data = $entity->writeData();
        $this->assertEquals($expectedData, $data);

        $newEntity = new IconEntity();
        $this->assertEquals($newEntity, $newEntity->readData(new DataContainer($data)));
        $this->assertEquals($newEntity, $entity);
    }
}
