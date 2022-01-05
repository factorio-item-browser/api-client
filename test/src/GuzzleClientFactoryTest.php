<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client;

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use FactorioItemBrowser\Api\Client\GuzzleClientFactory;
use GuzzleHttp\Client as GuzzleClient;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;

/**
 * The PHPUnit test of the GuzzleClientFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\GuzzleClientFactory
 */
class GuzzleClientFactoryTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function test(): void
    {
        $config = [
            ConfigKey::MAIN => [
                ConfigKey::API_KEY => 'abc',
                ConfigKey::BASE_URI => 'https://www.example.com/',
                ConfigKey::TIMEOUT => 42,
            ],
        ];

        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo('config'))
                  ->willReturn($config);

        $expectedResult = new GuzzleClient([
            'base_uri' => 'https://www.example.com/',
            'headers' => [
                'Api-Key' => 'abc',
            ],
            'timeout' => 42,
        ]);

        $instance = new GuzzleClientFactory();
        $result = $instance($container, GuzzleClient::class);

        $this->assertEquals($expectedResult, $result);
    }
}
