<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Error;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Error class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Entity\Error
 */
class ErrorTest extends TestCase
{
    /**
     * Tests the setting and getting the message.
     * @covers ::getMessage
     * @covers ::setMessage
     */
    public function testSetAndGetMessage(): void
    {
        $message = 'abc';
        $error = new Error();

        $this->assertSame($error, $error->setMessage($message));
        $this->assertSame($message, $error->getMessage());
    }
}
