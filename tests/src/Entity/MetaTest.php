<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\Api\Client\Entity\Message;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the meta class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Entity\Meta
 */
class MetaTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $meta = new Meta();
        $this->assertEquals(0, $meta->getStatusCode());
        $this->assertEquals(0., $meta->getExecutionTime());
        $this->assertEquals([], $meta->getMessages());
    }

    /**
     * Tests setting and getting the status code.
     */
    public function testSetAndGetStatusCode()
    {
        $meta = new Meta();
        $this->assertEquals($meta, $meta->setStatusCode(123));
        $this->assertEquals(123, $meta->getStatusCode());
    }

    /**
     * Tests setting and getting the execution time.
     */
    public function testSetAndGetExecutionTime()
    {
        $meta = new Meta();
        $this->assertEquals($meta, $meta->setExecutionTime(13.37));
        $this->assertEquals(13.37, $meta->getExecutionTime());
    }

    /**
     * Tests setting, adding and getting the messages.
     */
    public function testSetAddAndGetMessages()
    {
        $message1 = new Message();
        $message1->setType('abc');
        $message2 = new Message();
        $message2->setType('def');
        $message3 = new Message();
        $message3->setType('ghi');

        $meta = new Meta();
        $this->assertEquals($meta, $meta->setMessages([$message1, new Meta(), $message2]));
        $this->assertEquals([$message1, $message2], $meta->getMessages());

        $this->assertEquals($meta, $meta->addMessage($message3));
        $this->assertEquals([$message1, $message2, $message3], $meta->getMessages());
    }

    /**
     * Tests writing and reading the data.
     */
    public function testWriteAndReadData()
    {
        $message1 = new Message();
        $message1->setType('abc');
        $message2 = new Message();
        $message2->setType('def');

        $meta = new Meta();
        $meta->setStatusCode(123)
             ->setExecutionTime(13.37)
             ->addMessage($message1)
             ->addMessage($message2);

        $expectedData = [
            'statusCode' => 123,
            'executionTime' => 13.37,
            'messages' => [
                ['type' => 'abc', 'message' => ''],
                ['type' => 'def', 'message' => ''],
            ]
        ];

        $data = $meta->writeData();
        $this->assertEquals($expectedData, $data);

        $newMeta = new Meta();
        $this->assertEquals($newMeta, $newMeta->readData(new DataContainer($data)));
        $this->assertEquals($newMeta, $meta);
    }
}
