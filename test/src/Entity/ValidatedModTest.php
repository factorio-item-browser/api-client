<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\ValidatedMod;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ValidatedMod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\ValidatedMod
 */
class ValidatedModTest extends TestCase
{
    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $entity = new ValidatedMod();

        $this->assertSame($entity, $entity->setName($name));
        $this->assertSame($name, $entity->getName());
    }

    /**
     * Tests the setting and getting the version.
     * @covers ::getVersion
     * @covers ::setVersion
     */
    public function testSetAndGetVersion(): void
    {
        $version = '1.2.3';
        $entity = new ValidatedMod();

        $this->assertSame($entity, $entity->setVersion($version));
        $this->assertSame($version, $entity->getVersion());
    }

    /**
     * Tests the setting and getting the issue type.
     * @covers ::getIssueType
     * @covers ::setIssueType
     */
    public function testSetAndGetIssueType(): void
    {
        $issueType = 'abc';
        $entity = new ValidatedMod();

        $this->assertSame($entity, $entity->setIssueType($issueType));
        $this->assertSame($issueType, $entity->getIssueType());
    }

    /**
     * Tests the setting and getting the issue dependency.
     * @covers ::getIssueDependency
     * @covers ::setIssueDependency
     */
    public function testSetAndGetIssueDependency(): void
    {
        $issueDependency = 'abc';
        $entity = new ValidatedMod();

        $this->assertSame($entity, $entity->setIssueDependency($issueDependency));
        $this->assertSame($issueDependency, $entity->getIssueDependency());
    }
}
