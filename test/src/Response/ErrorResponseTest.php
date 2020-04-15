<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Response;

use FactorioItemBrowser\Api\Client\Entity\Error;
use FactorioItemBrowser\Api\Client\Response\ErrorResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ErrorResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Response\ErrorResponse
 */
class ErrorResponseTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $response = new ErrorResponse();

        $this->assertEquals(new Error(), $response->getError());
    }

    /**
     * Tests the setting and getting the error.
     * @covers ::getError
     * @covers ::setError
     */
    public function testSetAndGetError(): void
    {
        /* @var Error&MockObject $error */
        $error = $this->createMock(Error::class);

        $response = new ErrorResponse();

        $this->assertSame($response, $response->setError($error));
        $this->assertSame($error, $response->getError());
    }
}
