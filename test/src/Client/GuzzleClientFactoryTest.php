<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Client;

use FactorioItemBrowser\Api\Client\Client\GuzzleClientFactory;
use FactorioItemBrowser\Api\Client\Client\Options;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the GuzzleClientFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Client\GuzzleClientFactory
 */
class GuzzleClientFactoryTest extends TestCase
{
    /**
     * Tests the invoking.
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        $apiUrl = 'http://www.example.com';
        $timeout = 42;

        $expectedResult = new Client([
            'base_uri' => $apiUrl,
            'timeout' => $timeout,
        ]);

        /* @var Options&MockObject $options */
        $options = $this->createMock(Options::class);
        $options->expects($this->once())
                ->method('getApiUrl')
                ->willReturn($apiUrl);
        $options->expects($this->once())
                ->method('getTimeout')
                ->willReturn($timeout);

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->identicalTo(Options::class))
                  ->willReturn($options);

        $factory = new GuzzleClientFactory();
        $result = $factory($container, ClientInterface::class);

        $this->assertEquals($expectedResult, $result);
    }
}
