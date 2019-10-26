<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Export;

use FactorioItemBrowser\Api\Client\Entity\Export;
use FactorioItemBrowser\Api\Client\Response\Export\ExportCreateResponse;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the ExportCreateResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class ExportCreateResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $export = new Export();
        $export->setStatus('abc');

        $result = new ExportCreateResponse();
        $result->setExport($export);

        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'export' => [
                'status' => 'abc',
            ],
        ];
    }
}