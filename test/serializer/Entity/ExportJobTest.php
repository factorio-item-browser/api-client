<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Entity;

use DateTime;
use Exception;
use FactorioItemBrowser\Api\Client\Entity\ExportJob;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the Export class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ExportJobTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     * @throws Exception
     */
    protected function getObject(): object
    {
        $result = new ExportJob();
        $result->setStatus('abc')
               ->setCreationTime(new DateTime('2038-01-19 03:10:07'))
               ->setExportTime(new DateTime('2038-01-19 03:12:07'))
               ->setImportTime(new DateTime('2038-01-19 03:14:07'))
               ->setErrorMessage('def');

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'status' => 'abc',
            'creationTime' => '2038-01-19T03:10:07+00:00',
            'exportTime' => '2038-01-19T03:12:07+00:00',
            'importTime' => '2038-01-19T03:14:07+00:00',
            'errorMessage' => 'def',
        ];
    }
}