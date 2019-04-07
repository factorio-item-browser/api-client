<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer\Handler;

use FactorioItemBrowser\Api\Client\Serializer\Handler\Base64Handler;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the Base64Handler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Serializer\Handler\Base64Handler
 */
class Base64HandlerTest extends TestCase
{
    /**
     * Tests the getSubscribingMethods method.
     * @covers ::getSubscribingMethods
     */
    public function testGetSubscribingMethods(): void
    {
        $expectedResult = [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'base64',
                'method' => 'serializeBase64',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'base64',
                'method' => 'deserializeBase64',
            ],
        ];

        $result = Base64Handler::getSubscribingMethods();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the serializeBase64 method.
     * @throws ReflectionException
     * @covers ::serializeBase64
     */
    public function testSerializeBase64(): void
    {
        $data = 'abc';
        $encodedData = 'YWJj';
        $visitedString = 'def';
        $type = ['ghi'];

        /* @var SerializationVisitorInterface&MockObject $visitor */
        $visitor = $this->createMock(SerializationVisitorInterface::class);
        $visitor->expects($this->once())
                ->method('visitString')
                ->with($this->identicalTo($encodedData), $this->identicalTo($type))
                ->willReturn($visitedString);

        $handler = new Base64Handler();
        $result = $handler->serializeBase64($visitor, $data, $type);

        $this->assertSame($visitedString, $result);
    }

    /**
     * Tests the deserializeBase64 method.
     * @throws ReflectionException
     * @covers ::deserializeBase64
     */
    public function testDeserializeBase64(): void
    {
        $base64Data = 'abc';
        $visitedString = 'ZGVm';
        $decodedString = 'def';
        $type = ['ghi'];

        /* @var DeserializationVisitorInterface&MockObject $visitor */
        $visitor = $this->createMock(DeserializationVisitorInterface::class);
        $visitor->expects($this->once())
                ->method('visitString')
                ->with($this->identicalTo($base64Data), $this->identicalTo($type))
                ->willReturn($visitedString);


        $handler = new Base64Handler();
        $result = $handler->deserializeBase64($visitor, $base64Data, $type);

        $this->assertSame($decodedString, $result);
    }
}
