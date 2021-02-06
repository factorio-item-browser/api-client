<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\ConnectionException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ConnectionException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Exception\ConnectionException
 */
class ConnectionExceptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $message = 'abc';
        $request = 'def';
        $previous = $this->createMock(Exception::class);
        $expectedMessage = 'Failed to connect to the server: abc';

        $exception = new ConnectionException($message, $request, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame('', $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
