<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the meta class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Meta
 */
class MetaTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $meta = new Meta();
        $this->assertEquals(0, $meta->getStatusCode());
        $this->assertEquals(0., $meta->getExecutionTime());
        $this->assertEquals('', $meta->getErrorMessage());
    }

    /**
     * Tests setting and getting the status code.
     * @covers ::setStatusCode
     * @covers ::getStatusCode
     */
    public function testSetAndGetStatusCode()
    {
        $meta = new Meta();
        $this->assertEquals($meta, $meta->setStatusCode(123));
        $this->assertEquals(123, $meta->getStatusCode());
    }

    /**
     * Tests setting and getting the execution time.
     * @covers ::setExecutionTime
     * @covers ::getExecutionTime
     */
    public function testSetAndGetExecutionTime()
    {
        $meta = new Meta();
        $this->assertEquals($meta, $meta->setExecutionTime(13.37));
        $this->assertEquals(13.37, $meta->getExecutionTime());
    }

    /**
     * Tests setting and getting the error message.
     * @covers ::setErrorMessage
     * @covers ::getErrorMessage
     */
    public function testSetAndGetErrorMessage()
    {
        $meta = new Meta();
        $this->assertEquals($meta, $meta->setErrorMessage('abc'));
        $this->assertEquals('abc', $meta->getErrorMessage());
    }


    /**
     * Tests writing and reading the data.
     * @covers ::writeData
     * @covers ::readData
     */
    public function testWriteAndReadData()
    {
        $meta = new Meta();
        $meta->setStatusCode(123)
             ->setExecutionTime(13.37)
             ->setErrorMessage('abc');

        $expectedData = [
            'statusCode' => 123,
            'executionTime' => 13.37,
            'errorMessage' => 'abc'
        ];

        $data = $meta->writeData();
        $this->assertEquals($expectedData, $data);

        $newMeta = new Meta();
        $this->assertEquals($newMeta, $newMeta->readData(new DataContainer($data)));
        $this->assertEquals($newMeta, $meta);
    }
}
