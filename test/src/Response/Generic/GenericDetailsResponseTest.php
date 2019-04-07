<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Generic;

use FactorioItemBrowser\Api\Client\Entity\GenericEntity;
use FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the generic details response class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Generic\GenericDetailsResponse
 */
class GenericDetailsResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $response = new GenericDetailsResponse();

        $this->assertSame([], $response->getEntities());
    }

    /**
     * Tests setting, adding and getting the entities.
     * @throws ReflectionException
     * @covers ::addEntity
     * @covers ::setEntities
     * @covers ::getEntities
     */
    public function testSetAddAndGetIconEntities(): void
    {
        /* @var GenericEntity&MockObject $entity1 */
        $entity1 = $this->createMock(GenericEntity::class);
        /* @var GenericEntity&MockObject $entity2 */
        $entity2 = $this->createMock(GenericEntity::class);
        /* @var GenericEntity&MockObject $entity3 */
        $entity3 = $this->createMock(GenericEntity::class);

        $response = new GenericDetailsResponse();
        $this->assertSame($response, $response->setEntities([$entity1, $entity2]));
        $this->assertSame([$entity1, $entity2], $response->getEntities());

        $this->assertSame($response, $response->addEntity($entity3));
        $this->assertSame([$entity1, $entity2, $entity3], $response->getEntities());
    }
}
