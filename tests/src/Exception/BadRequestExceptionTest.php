<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the bad request exception class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Exception\BadRequestException
 */
class BadRequestExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $message = 'abc';
        $code = 400;
        $request = 'def';
        $response = 'ghi';
        $previous = new Exception('jkl');

        $exception = new BadRequestException($message, $request, $response, $previous);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
        $this->assertEquals($request, $exception->getRequest());
        $this->assertEquals($response, $exception->getResponse());
        $this->assertEquals($previous, $exception->getPrevious());
    }
}
