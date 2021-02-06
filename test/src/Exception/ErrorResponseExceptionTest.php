<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\ErrorResponseException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ErrorResponseException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Exception\ErrorResponseException
 */
class ErrorResponseExceptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $message = 'abc';
        $statusCode = 417;
        $request = 'def';
        $response = 'ghi';
        $expectedMessage = 'The request returned a status code 417: abc';
        $previous = $this->createMock(Exception::class);

        $exception = new ErrorResponseException($message, $statusCode, $request, $response, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame($statusCode, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
