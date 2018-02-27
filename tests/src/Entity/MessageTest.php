<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use FactorioItemBrowser\Api\Client\Entity\Message;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the message class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Entity\Message
 */
class MessageTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $message = new Message();
        $this->assertEquals('', $message->getType());
        $this->assertEquals('', $message->getMessage());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $message = new Message();
        $this->assertEquals($message, $message->setType('abc'));
        $this->assertEquals('abc', $message->getType());
    }

    /**
     * Tests setting and getting the message.
     */
    public function testSetAndGetMessage()
    {
        $message = new Message();
        $this->assertEquals($message, $message->setMessage('abc'));
        $this->assertEquals('abc', $message->getMessage());
    }
}
