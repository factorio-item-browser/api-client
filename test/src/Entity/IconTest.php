<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Icon;
use FactorioItemBrowser\Api\Client\Entity\IconEntity;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Icon
 */
class IconTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $icon = new Icon();
        $this->assertSame([], $icon->getEntities());
        $this->assertSame('', $icon->getContent());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @covers ::setEntities
     * @covers ::addEntity
     * @covers ::getEntities
     */
    public function testSetAddAndGetIconEntities()
    {
        $entity1 = new IconEntity();
        $entity1->setType('abc');
        $entity2 = new IconEntity();
        $entity2->setType('def');
        $entity3 = new IconEntity();
        $entity3->setType('ghi');

        $icon = new Icon();
        $this->assertSame($icon, $icon->setEntities([$entity1, $entity2]));
        $this->assertSame([$entity1, $entity2], $icon->getEntities());

        $this->assertSame($icon, $icon->addEntity($entity3));
        $this->assertSame([$entity1, $entity2, $entity3], $icon->getEntities());
    }

    /**
     * Tests setting and getting the content.
     * @covers ::setContent
     * @covers ::getContent
     */
    public function testSetAndGetContent()
    {
        $item = new Icon();
        $this->assertSame($item, $item->setContent('abc'));
        $this->assertSame('abc', $item->getContent());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $entity1 = new IconEntity();
        $entity1->setType('abc');
        $entity2 = new IconEntity();
        $entity2->setType('def');

        $icon = new Icon();
        $icon->addEntity($entity1)
             ->addEntity($entity2)
             ->setContent('ghi');

        $expectedData = [
            'entities' => [
                [
                    'type' => 'abc',
                    'name' => '',
                ],
                [
                    'type' => 'def',
                    'name' => '',
                ],
            ],
            'content' => 'ghi',
        ];

        $data = $icon->writeData();
        $this->assertEquals($expectedData, $data);

        $newIcon = new Icon();
        $this->assertSame($newIcon, $newIcon->readData(new DataContainer($data)));
        $this->assertEquals($newIcon, $icon);
    }
}
