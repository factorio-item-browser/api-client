<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\TimeoutException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the timeout exception class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Exception\TimeoutException
 */
class TimeoutExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $message = 'Requested timed out.';
        $code = 408;
        $request = 'def';
        $response = '';
        $previous = new Exception('jkl');

        $exception = new TimeoutException($request, $previous);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
        $this->assertEquals($request, $exception->getRequest());
        $this->assertEquals($response, $exception->getResponse());
        $this->assertEquals($previous, $exception->getPrevious());
    }
}
