<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\ClientException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ClientException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Exception\ClientException
 */
class ClientExceptionTest extends TestCase
{
    public function testConstruct(): void
    {
        $message = 'abc';
        $code = 123;
        $request = 'def';
        $response = 'ghi';
        $previous = $this->createMock(Exception::class);

        $exception = new ClientException($message, $code, $request, $response, $previous);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
