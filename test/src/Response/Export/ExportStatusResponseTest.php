<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Export;

use FactorioItemBrowser\Api\Client\Entity\Export;
use FactorioItemBrowser\Api\Client\Response\Export\ExportStatusResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ExportStatusResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Export\ExportStatusResponse
 */
class ExportStatusResponseTest extends TestCase
{
    /**
     * Tests the setting and getting the export.
     * @covers ::getExport
     * @covers ::setExport
     */
    public function testSetAndGetExport(): void
    {
        /* @var Export&MockObject $export */
        $export = $this->createMock(Export::class);
        $entity = new ExportStatusResponse();

        $this->assertSame($entity, $entity->setExport($export));
        $this->assertSame($export, $entity->getExport());
    }
}
