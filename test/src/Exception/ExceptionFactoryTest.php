<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Exception;

use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\BadRequestException;
use FactorioItemBrowser\Api\Client\Exception\ExceptionFactory;
use FactorioItemBrowser\Api\Client\Exception\ForbiddenException;
use FactorioItemBrowser\Api\Client\Exception\NotFoundException;
use FactorioItemBrowser\Api\Client\Exception\UnauthorizedException;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the exception factory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Exception\ExceptionFactory
 */
class ExceptionFactoryTest extends TestCase
{
    /**
     * Provides the data for the create test.
     * @return array
     */
    public function provideCreate(): array
    {
        return [
            [400, BadRequestException::class],
            [401, UnauthorizedException::class],
            [403, ForbiddenException::class],
            [404, NotFoundException::class],
            [500, ApiClientException::class],
            [0, ApiClientException::class],
        ];
    }

    /**
     * Tests the create method.
     * @param int $statusCode
     * @param string $expectedExceptionClass
     * @covers ::create
     * @dataProvider provideCreate
     */
    public function testCreate(int $statusCode, string $expectedExceptionClass): void
    {
        $exception = ExceptionFactory::create($statusCode, 'abc', 'def', 'ghi');
        $this->assertInstanceOf($expectedExceptionClass, $exception);
    }
}
