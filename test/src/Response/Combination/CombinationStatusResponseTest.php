<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ExportJob;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationStatusResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the CombinationStatusResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\Combination\CombinationStatusResponse
 */
class CombinationStatusResponseTest extends TestCase
{
    /**
     * Tests the setting and getting the id.
     * @covers ::getId
     * @covers ::setId
     */
    public function testSetAndGetId(): void
    {
        $id = 'abc';
        $response = new CombinationStatusResponse();

        $this->assertSame($response, $response->setId($id));
        $this->assertSame($id, $response->getId());
    }

    /**
     * Tests the setting and getting the mod names.
     * @covers ::getModNames
     * @covers ::setModNames
     */
    public function testSetAndGetModNames(): void
    {
        $modNames = ['abc', 'def'];
        $response = new CombinationStatusResponse();

        $this->assertSame($response, $response->setModNames($modNames));
        $this->assertSame($modNames, $response->getModNames());
    }

    /**
     * Tests the setting and getting the latest export job.
     * @covers ::getLatestExportJob
     * @covers ::setLatestExportJob
     */
    public function testSetAndGetLatestExportJob(): void
    {
        /* @var ExportJob&MockObject $latestExportJob */
        $latestExportJob = $this->createMock(ExportJob::class);
        $response = new CombinationStatusResponse();

        $this->assertSame($response, $response->setLatestExportJob($latestExportJob));
        $this->assertSame($latestExportJob, $response->getLatestExportJob());
    }

    /**
     * Tests the setting and getting the latest successful export job.
     * @covers ::getLatestSuccessfulExportJob
     * @covers ::setLatestSuccessfulExportJob
     */
    public function testSetAndGetLatestSuccessfulExportJob(): void
    {
        /* @var ExportJob&MockObject $latestSuccessfulExportJob */
        $latestSuccessfulExportJob = $this->createMock(ExportJob::class);
        $response = new CombinationStatusResponse();

        $this->assertSame($response, $response->setLatestSuccessfulExportJob($latestSuccessfulExportJob));
        $this->assertSame($latestSuccessfulExportJob, $response->getLatestSuccessfulExportJob());
    }
}
