<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client;

use FactorioItemBrowser\Api\Client\ConfigProvider;
use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ConfigProvider class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\ConfigProvider
 */
class ConfigProviderTest extends TestCase
{
    public function testInvoke(): void
    {
        $configProvider = new ConfigProvider();
        $result = $configProvider();

        $this->assertArrayHasKey('dependencies', $result);
        $this->assertArrayHasKey('factories', $result['dependencies']);

        $this->assertArrayHasKey(ConfigKey::MAIN, $result);
        $this->assertArrayHasKey(ConfigKey::ENDPOINTS, $result[ConfigKey::MAIN]);
        $this->assertArrayHasKey(ConfigKey::SERIALIZER, $result[ConfigKey::MAIN]);
    }
}
