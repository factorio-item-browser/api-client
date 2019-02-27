<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\RequestEntity;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the RequestEntity class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\RequestEntity
 */
class RequestEntityTest extends TestCase
{
    /**
     * Tests the setting and getting the type.
     * @covers ::getType
     * @covers ::setType
     */
    public function testSetAndGetType(): void
    {
        $type = 'abc';
        $entity = new RequestEntity();

        $this->assertSame($entity, $entity->setType($type));
        $this->assertSame($type, $entity->getType());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $entity = new RequestEntity();

        $this->assertSame($entity, $entity->setName($name));
        $this->assertSame($name, $entity->getName());
    }
}
