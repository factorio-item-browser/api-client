<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use FactorioItemBrowser\Api\Client\Exception\ErrorResponseException;
use FactorioItemBrowser\Api\Client\Exception\ErrorResponseExceptionFactory;
use FactorioItemBrowser\Api\Client\Exception\NotFoundException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ErrorResponseExceptionFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Exception\ErrorResponseExceptionFactory
 */
class ErrorResponseExceptionFactoryTest extends TestCase
{
    /**
     * @return array<mixed>
     */
    public function provideCreate(): array
    {
        return [
            [400, BadRequestException::class],
            [401, UnauthorizedException::class],
            [404, NotFoundException::class],
            [500, ErrorResponseException::class],
            [0, ErrorResponseException::class],
        ];
    }

    /**
     * @param int $statusCode
     * @param class-string $expectedExceptionClass
     * @dataProvider provideCreate
     */
    public function testCreate(int $statusCode, string $expectedExceptionClass): void
    {
        $exception = ErrorResponseExceptionFactory::create($statusCode, 'abc', 'def', 'ghi');
        $this->assertInstanceOf($expectedExceptionClass, $exception);
    }
}
