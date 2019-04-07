<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client;

use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\Api\Client\ApiClient;
use FactorioItemBrowser\Api\Client\ApiClientFactory;
use FactorioItemBrowser\Api\Client\Client\Options;
use FactorioItemBrowser\Api\Client\Constant\ServiceName;
use FactorioItemBrowser\Api\Client\Service\EndpointService;
use GuzzleHttp\Client;
use Interop\Container\ContainerInterface;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ApiClientFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\ApiClientFactory
 */
class ApiClientFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the invoking.
     * @throws ReflectionException
     * @covers ::__invoke
     */
    public function testInvoke(): void
    {
        /* @var EndpointService&MockObject $endpointService */
        $endpointService = $this->createMock(EndpointService::class);
        /* @var Client&MockObject $guzzleClient */
        $guzzleClient = $this->createMock(Client::class);
        /* @var Options&MockObject $options */
        $options = $this->createMock(Options::class);
        /* @var SerializerInterface&MockObject $serializer */
        $serializer = $this->createMock(SerializerInterface::class);

        $expectedResult = new ApiClient($endpointService, $guzzleClient, $options, $serializer);

        /* @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->exactly(4))
                  ->method('get')
                  ->withConsecutive(
                      [$this->identicalTo(EndpointService::class)],
                      [$this->identicalTo(ServiceName::GUZZLE_CLIENT)],
                      [$this->identicalTo(Options::class)],
                      [$this->identicalTo(ServiceName::SERIALIZER)]
                  )
                  ->willReturnOnConsecutiveCalls(
                      $endpointService,
                      $guzzleClient,
                      $options,
                      $serializer
                  );

        $factory = new ApiClientFactory();
        $result = $factory($container, ApiClient::class);

        $this->assertEquals($expectedResult, $result);
    }
}
