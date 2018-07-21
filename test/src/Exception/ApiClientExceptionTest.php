<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the API client exception class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Exception\ApiClientException
 */
class ApiClientExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     * @covers ::getRequest
     * @covers ::getResponse
     */
    public function testConstruct()
    {
        $message = 'abc';
        $code = 123;
        $request = 'def';
        $response = 'ghi';
        $previous = new Exception('jkl');

        $exception = new ApiClientException($message, $code, $request, $response, $previous);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
