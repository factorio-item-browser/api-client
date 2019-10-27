<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Entity\Entity;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the generic details request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Generic\GenericDetailsRequest
 */
class GenericDetailsRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new GenericDetailsRequest();

        $this->assertSame([], $request->getEntities());
    }

    /**
     * Tests the setting and getting the entities.
     * @covers ::addEntity
     * @covers ::getEntities
     * @covers ::setEntities
     */
    public function testSetAddAndGetEntities(): void
    {
        /* @var Entity&MockObject $entity1 */
        $entity1 = $this->createMock(Entity::class);
        /* @var Entity&MockObject $entity2 */
        $entity2 = $this->createMock(Entity::class);
        /* @var Entity&MockObject $entity3 */
        $entity3 = $this->createMock(Entity::class);

        $entities = [$entity1, $entity2];
        $request = new GenericDetailsRequest();

        $this->assertSame($request, $request->setEntities($entities));
        $this->assertSame($entities, $request->getEntities());
        $this->assertSame($request, $request->addEntity($entity3));
        $this->assertSame([$entity1, $entity2, $entity3], $request->getEntities());
    }
}
