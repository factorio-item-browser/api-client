<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Mod;
use FactorioItemBrowser\Common\Constant\EntityType;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::getType
     */
    public function testConstruct(): void
    {
        $mod = new Mod();

        $this->assertSame(EntityType::MOD, $mod->getType());
        $this->assertSame('', $mod->getName());
        $this->assertSame('', $mod->getLabel());
        $this->assertSame('', $mod->getDescription());
        $this->assertSame('', $mod->getAuthor());
        $this->assertSame('', $mod->getVersion());
        $this->assertFalse($mod->getIsEnabled());
    }

    /**
     * Tests the setting and getting the author.
     * @covers ::getAuthor
     * @covers ::setAuthor
     */
    public function testSetAndGetAuthor(): void
    {
        $author = 'abc';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setAuthor($author));
        $this->assertSame($author, $entity->getAuthor());
    }

    /**
     * Tests the setting and getting the version.
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testSetAndGetVersion(): void
    {
        $version = '1.2.3';
        $entity = new Mod();

        $this->assertSame($entity, $entity->setVersion($version));
        $this->assertSame($version, $entity->getVersion());
    }

    /**
     * Tests the setting and getting the is enabled.
     * @covers ::getIsEnabled
     * @covers ::setIsEnabled
     */
    public function testSetAndGetIsEnabled(): void
    {
        $isEnabled = true;
        $entity = new Mod();

        $this->assertSame($entity, $entity->setIsEnabled($isEnabled));
        $this->assertTrue($entity->getIsEnabled());
    }
}
