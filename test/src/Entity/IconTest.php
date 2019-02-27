<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Entity;
use FactorioItemBrowser\Api\Client\Entity\Icon;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
    public function testConstruct(): void
    {
        $icon = new Icon();

        $this->assertSame([], $icon->getEntities());
        $this->assertSame('', $icon->getContent());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @throws ReflectionException
     * @covers ::addEntity
     * @covers ::setEntities
     * @covers ::getEntities
     */
    public function testSetAddAndGetIconEntities(): void
    {
        /* @var Entity&MockObject $entity1 */
        $entity1 = $this->createMock(Entity::class);
        /* @var Entity&MockObject $entity2 */
        $entity2 = $this->createMock(Entity::class);
        /* @var Entity&MockObject $entity3 */
        $entity3 = $this->createMock(Entity::class);

        $icon = new Icon();
        $this->assertSame($icon, $icon->setEntities([$entity1, $entity2]));
        $this->assertSame([$entity1, $entity2], $icon->getEntities());

        $this->assertSame($icon, $icon->addEntity($entity3));
        $this->assertSame([$entity1, $entity2, $entity3], $icon->getEntities());
    }

    /**
     * Tests the setting and getting the content.
     * @covers ::getContent
     * @covers ::setContent
     */
    public function testSetAndGetContent(): void
    {
        $content = 'abc';
        $entity = new Icon();

        $this->assertSame($entity, $entity->setContent($content));
        $this->assertSame($content, $entity->getContent());
    }
}
