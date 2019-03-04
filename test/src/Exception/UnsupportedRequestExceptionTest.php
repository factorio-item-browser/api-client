<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use Exception;
use FactorioItemBrowser\Api\Client\Exception\UnsupportedRequestException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the UnsupportedRequestException class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Exception\UnsupportedRequestException
 */
class UnsupportedRequestExceptionTest extends TestCase
{
    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $requestClass = 'abc';
        $expectedMessage = 'The request abc cannot be matched by any endpoint.';

        /* @var Exception&MockObject $previous */
        $previous = $this->createMock(Exception::class);

        $exception = new UnsupportedRequestException($requestClass, $previous);

        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame('', $exception->getRequest());
        $this->assertSame('', $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
