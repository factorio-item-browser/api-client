<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Serializer\Handler;

use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;

/**
 * The handler for the base64 data type.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Base64Handler implements SubscribingHandlerInterface
{
    /**
     * Returns the methods to subscribe to.
     * @return array<mixed>
     */
    public static function getSubscribingMethods()
    {
        return [
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
    }

    /**
     * Serializes the data to base64.
     * @param SerializationVisitorInterface $visitor
     * @param string $data
     * @param array|string[] $type
     * @return mixed
     */
    public function serializeBase64(SerializationVisitorInterface $visitor, string $data, array $type)
    {
        return $visitor->visitString(base64_encode($data), $type);
    }

    /**
     * Deserializes the base64 string.
     * @param DeserializationVisitorInterface $visitor
     * @param mixed $base64
     * @param array|string[] $type
     * @return string
     */
    public function deserializeBase64(DeserializationVisitorInterface $visitor, $base64, array $type): string
    {
        return (string) base64_decode($visitor->visitString($base64, $type), true);
    }
}
