<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Mod;
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
     * @coversNothing
     */
    public function testConstruct()
    {
        $mod = new Mod();
        $this->assertSame('mod', $mod->getType());
        $this->assertSame('', $mod->getName());
        $this->assertSame('', $mod->getLabel());
        $this->assertSame('', $mod->getDescription());
        $this->assertSame('', $mod->getAuthor());
        $this->assertSame('', $mod->getVersion());
        $this->assertSame(false, $mod->getIsEnabled());
    }

    /**
     * Tests getting the type.
     * @covers ::getType
     */
    public function testGetType()
    {
        $mod = new Mod();
        $this->assertSame('mod', $mod->getType());
    }

    /**
     * Tests setting and getting the author.
     * @covers ::setAuthor
     * @covers ::getAuthor
     */
    public function testSetAndGetAuthor()
    {
        $mod = new Mod();
        $this->assertSame($mod, $mod->setAuthor('abc'));
        $this->assertSame('abc', $mod->getAuthor());
    }

    /**
     * Tests setting and getting the version.
     * @covers ::setVersion
     * @covers ::getVersion
     */
    public function testSetAndGetVersion()
    {
        $mod = new Mod();
        $this->assertSame($mod, $mod->setVersion('abc'));
        $this->assertSame('abc', $mod->getVersion());
    }

    /**
     * Tests setting and getting the enabled flag.
     * @covers ::setIsEnabled
     * @covers ::getIsEnabled
     */
    public function testSetAndGetIsEnabled()
    {
        $mod = new Mod();
        $this->assertSame($mod, $mod->setIsEnabled(true));
        $this->assertSame(true, $mod->getIsEnabled());
    }

    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $mod = new Mod();
        $mod->setName('abc')
            ->setLabel('def')
            ->setDescription('ghi')
            ->setAuthor('jkl')
            ->setVersion('4.2.0')
            ->setIsEnabled(true);

        $expectedData = [
            'name' => 'abc',
            'label' => 'def',
            'description' => 'ghi',
            'author' => 'jkl',
            'version' => '4.2.0',
            'isEnabled' => true
        ];

        $data = $mod->writeData();
        $this->assertEquals($expectedData, $data);

        $newMod = new Mod();
        $this->assertSame($newMod, $newMod->readData(new DataContainer($data)));
        $this->assertEquals($newMod, $mod);
    }
}
