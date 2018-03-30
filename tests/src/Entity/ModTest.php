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
        $this->assertEquals('mod', $mod->getType());
        $this->assertEquals('', $mod->getName());
        $this->assertEquals('', $mod->getLabel());
        $this->assertEquals('', $mod->getDescription());
        $this->assertEquals('', $mod->getAuthor());
        $this->assertEquals('', $mod->getVersion());
        $this->assertEquals(false, $mod->getIsEnabled());
    }

    /**
     * Tests getting the type.
     * @covers ::getType
     */
    public function testGetType()
    {
        $mod = new Mod();
        $this->assertEquals('mod', $mod->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setName('abc'));
        $this->assertEquals('abc', $mod->getName());
    }

    /**
     * Tests setting and getting the label.
     * @covers ::setLabel
     * @covers ::getLabel
     */
    public function testSetAndGetLabel()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setLabel('abc'));
        $this->assertEquals('abc', $mod->getLabel());
    }

    /**
     * Tests setting and getting the description.
     * @covers ::setDescription
     * @covers ::getDescription
     */
    public function testSetAndGetDescription()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setDescription('abc'));
        $this->assertEquals('abc', $mod->getDescription());
    }

    /**
     * Tests setting and getting the author.
     * @covers ::setAuthor
     * @covers ::getAuthor
     */
    public function testSetAndGetAuthor()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setAuthor('abc'));
        $this->assertEquals('abc', $mod->getAuthor());
    }

    /**
     * Tests setting and getting the version.
     * @covers ::setVersion
     * @covers ::getVersion
     */
    public function testSetAndGetVersion()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setVersion('abc'));
        $this->assertEquals('abc', $mod->getVersion());
    }

    /**
     * Tests setting and getting the enabled flag.
     * @covers ::setIsEnabled
     * @covers ::getIsEnabled
     */
    public function testSetAndGetIsEnabled()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setIsEnabled(true));
        $this->assertEquals(true, $mod->getIsEnabled());
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
        $this->assertEquals($newMod, $newMod->readData(new DataContainer($data)));
        $this->assertEquals($newMod, $mod);
    }
}
