<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ExportJob;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationStatusResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the CombinationStatusResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class CombinationStatusResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $latestExportJob = new ExportJob();
        $latestExportJob->setStatus('abc');

        $latestSuccessfulExportJob = new ExportJob();
        $latestSuccessfulExportJob->setStatus('def');

        $result = new CombinationStatusResponse();
        $result->setId('ghi')
               ->setModNames(['jkl', 'mno'])
               ->setLatestExportJob($latestExportJob)
               ->setLatestSuccessfulExportJob($latestSuccessfulExportJob);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'id' => 'ghi',
            'modNames' => ['jkl', 'mno'],
            'latestExportJob' => [
                'status' => 'abc',
                'errorMessage' => '',
            ],
            'latestSuccessfulExportJob' => [
                'status' => 'def',
                'errorMessage' => '',
            ],
        ];
    }
}
