<?php

namespace FactorioItemBrowserTest\Api\Client\Client;

use FactorioItemBrowser\Api\Client\Client\Options;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the options class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Client\Options
 */
class OptionsTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $options = new Options();

        $this->assertSame('', $options->getApiUrl());
        $this->assertSame('', $options->getAccessKey());
        $this->assertSame(0, $options->getTimeout());
        $this->assertSame('en', $options->getLocale());
        $this->assertSame([], $options->getModNames());
        $this->assertSame('', $options->getAuthorizationToken());
    }

    /**
     * Tests the setting and getting the api url.
     * @covers ::getApiUrl
     * @covers ::setApiUrl
     */
    public function testSetAndGetApiUrl(): void
    {
        $apiUrl = 'http://example.com/';
        $options = new Options();

        $this->assertSame($options, $options->setApiUrl($apiUrl));
        $this->assertSame($apiUrl, $options->getApiUrl());
    }

    /**
     * Tests the setting and getting the access key.
     * @covers ::getAccessKey
     * @covers ::setAccessKey
     */
    public function testSetAndGetAccessKey(): void
    {
        $accessKey = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setAccessKey($accessKey));
        $this->assertSame($accessKey, $options->getAccessKey());
    }

    /**
     * Tests the setting and getting the timeout.
     * @covers ::getTimeout
     * @covers ::setTimeout
     */
    public function testSetAndGetTimeout(): void
    {
        $timeout = 42;
        $options = new Options();

        $this->assertSame($options, $options->setTimeout($timeout));
        $this->assertSame($timeout, $options->getTimeout());
    }

    /**
     * Tests the setting and getting the locale.
     * @covers ::getLocale
     * @covers ::setLocale
     */
    public function testSetAndGetLocale(): void
    {
        $locale = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setLocale($locale));
        $this->assertSame($locale, $options->getLocale());
    }

    /**
     * Tests the setting and getting the mod names.
     * @covers ::getModNames
     * @covers ::setModNames
     */
    public function testSetAndGetModNames(): void
    {
        $modNames = ['abc', 'def'];
        $options = new Options();

        $this->assertSame($options, $options->setModNames($modNames));
        $this->assertSame($modNames, $options->getModNames());
    }

    /**
     * Tests the setting and getting the authorization token.
     * @covers ::getAuthorizationToken
     * @covers ::setAuthorizationToken
     */
    public function testSetAndGetAuthorizationToken(): void
    {
        $authorizationToken = 'abc';
        $options = new Options();

        $this->assertSame($options, $options->setAuthorizationToken($authorizationToken));
        $this->assertSame($authorizationToken, $options->getAuthorizationToken());
    }
}
