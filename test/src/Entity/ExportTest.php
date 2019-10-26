<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use DateTime;
use FactorioItemBrowser\Api\Client\Entity\Export;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Export class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Export
 */
class ExportTest extends TestCase
{
    /**
     * Tests the setting and getting the status.
     * @covers ::getStatus
     * @covers ::setStatus
     */
    public function testSetAndGetStatus(): void
    {
        $status = 'abc';
        $export = new Export();

        $this->assertSame($export, $export->setStatus($status));
        $this->assertSame($status, $export->getStatus());
    }

    /**
     * Tests the setting and getting the creation time.
     * @covers ::getCreationTime
     * @covers ::setCreationTime
     */
    public function testSetAndGetCreationTime(): void
    {
        $creationTime = new DateTime('2038-01-19 03:14:07');
        $export = new Export();

        $this->assertSame($export, $export->setCreationTime($creationTime));
        $this->assertSame($creationTime, $export->getCreationTime());
    }

    /**
     * Tests the setting and getting the export time.
     * @covers ::getExportTime
     * @covers ::setExportTime
     */
    public function testSetAndGetExportTime(): void
    {
        $exportTime = new DateTime('2038-01-19 03:14:07');
        $export = new Export();

        $this->assertSame($export, $export->setExportTime($exportTime));
        $this->assertSame($exportTime, $export->getExportTime());
    }

    /**
     * Tests the setting and getting the import time.
     * @covers ::getImportTime
     * @covers ::setImportTime
     */
    public function testSetAndGetImportTime(): void
    {
        $importTime = new DateTime('2038-01-19 03:14:07');
        $export = new Export();

        $this->assertSame($export, $export->setImportTime($importTime));
        $this->assertSame($importTime, $export->getImportTime());
    }
}
