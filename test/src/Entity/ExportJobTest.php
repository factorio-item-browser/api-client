<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use DateTime;
use FactorioItemBrowser\Api\Client\Entity\ExportJob;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ExportJob class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\ExportJob
 */
class ExportJobTest extends TestCase
{
    /**
     * Tests the setting and getting the status.
     * @covers ::getStatus
     * @covers ::setStatus
     */
    public function testSetAndGetStatus(): void
    {
        $status = 'abc';
        $entity = new ExportJob();

        $this->assertSame($entity, $entity->setStatus($status));
        $this->assertSame($status, $entity->getStatus());
    }

    /**
     * Tests the setting and getting the creation time.
     * @covers ::getCreationTime
     * @covers ::setCreationTime
     */
    public function testSetAndGetCreationTime(): void
    {
        $creationTime = new DateTime('2038-01-19 03:14:07');
        $entity = new ExportJob();

        $this->assertSame($entity, $entity->setCreationTime($creationTime));
        $this->assertSame($creationTime, $entity->getCreationTime());
    }

    /**
     * Tests the setting and getting the export time.
     * @covers ::getExportTime
     * @covers ::setExportTime
     */
    public function testSetAndGetExportTime(): void
    {
        $exportTime = new DateTime('2038-01-19 03:14:07');
        $entity = new ExportJob();

        $this->assertSame($entity, $entity->setExportTime($exportTime));
        $this->assertSame($exportTime, $entity->getExportTime());
    }

    /**
     * Tests the setting and getting the import time.
     * @covers ::getImportTime
     * @covers ::setImportTime
     */
    public function testSetAndGetImportTime(): void
    {
        $importTime = new DateTime('2038-01-19 03:14:07');
        $entity = new ExportJob();

        $this->assertSame($entity, $entity->setImportTime($importTime));
        $this->assertSame($importTime, $entity->getImportTime());
    }

    /**
     * Tests the setting and getting the error message.
     * @covers ::getErrorMessage
     * @covers ::setErrorMessage
     */
    public function testSetAndGetErrorMessage(): void
    {
        $errorMessage = 'abc';
        $entity = new ExportJob();

        $this->assertSame($entity, $entity->setErrorMessage($errorMessage));
        $this->assertSame($errorMessage, $entity->getErrorMessage());
    }
}
