<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the unauthorized exception class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Exception\UnauthorizedException
 */
class UnauthorizedExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $message = 'abc';
        $code = 401;
        $request = 'def';
        $response = 'ghi';
        $previous = new Exception('jkl');

        $exception = new UnauthorizedException($message, $request, $response, $previous);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
