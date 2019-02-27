<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

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
    public function testConstruct(): void
    {
        $entity = new GenericEntity();

        $this->assertSame('', $entity->getType());
        $this->assertSame('', $entity->getName());
        $this->assertSame('', $entity->getLabel());
        $this->assertSame('', $entity->getDescription());
    }

    /**
     * Tests the setting and getting the label.
     * @covers ::getLabel
     * @covers ::setLabel
     */
    public function testSetAndGetLabel(): void
    {
        $label = 'abc';
        $entity = new GenericEntity();

        $this->assertSame($entity, $entity->setLabel($label));
        $this->assertSame($label, $entity->getLabel());
    }

    /**
     * Tests the setting and getting the description.
     * @covers ::getDescription
     * @covers ::setDescription
     */
    public function testSetAndGetDescription(): void
    {
        $description = 'abc';
        $entity = new GenericEntity();

        $this->assertSame($entity, $entity->setDescription($description));
        $this->assertSame($description, $entity->getDescription());
    }
}
