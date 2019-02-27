<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Entity\RequestEntity;
use FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the generic icon request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Generic\GenericIconRequest
 */
class GenericIconRequestTest extends TestCase
{
    /**
     * Tests the setting and getting the entities.
     * @throws ReflectionException
     * @covers ::addEntity
     * @covers ::getEntities
     * @covers ::setEntities
     */
    public function testSetAddAndGetEntities(): void
    {
        /* @var RequestEntity&MockObject $entity1 */
        $entity1 = $this->createMock(RequestEntity::class);
        /* @var RequestEntity&MockObject $entity2 */
        $entity2 = $this->createMock(RequestEntity::class);
        /* @var RequestEntity&MockObject $entity3 */
        $entity3 = $this->createMock(RequestEntity::class);

        $entities = [$entity1, $entity2];
        $request = new GenericIconRequest();

        $this->assertSame($request, $request->setEntities($entities));
        $this->assertSame($entities, $request->getEntities());
        $this->assertSame($request, $request->addEntity($entity3));
        $this->assertSame([$entity1, $entity2, $entity3], $request->getEntities());
    }
}
