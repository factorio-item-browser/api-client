<?php

namespace FactorioItemBrowserTest\Api\Client\Client;

use FactorioItemBrowser\Api\Client\Client\Options;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the options class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass FactorioItemBrowser\Api\Client\Client\Options
 */
class OptionsTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $options = new Options();
        $this->assertEquals('', $options->getApiUrl());
        $this->assertEquals('', $options->getAgent());
        $this->assertEquals('', $options->getAccessKey());
        $this->assertEquals(0, $options->getTimeout());
    }

    /**
     * Tests setting and getting the API URL.
     */
    public function testSetAndGetApiUrl()
    {
        $apiUrl = 'http://localhost/api';
        $options = new Options();
        $this->assertEquals($options, $options->setApiUrl($apiUrl));
        $this->assertEquals($apiUrl, $options->getApiUrl());
    }

    /**
     * Tests setting and getting the agent.
     */
    public function testSetAndGetAgent()
    {
        $options = new Options();
        $this->assertEquals($options, $options->setAgent('abc'));
        $this->assertEquals('abc', $options->getAgent());
    }

    /**
     * Tests setting and getting the access key.
     */
    public function testSetAndGetAccessKey()
    {
        $options = new Options();
        $this->assertEquals($options, $options->setAccessKey('abc'));
        $this->assertEquals('abc', $options->getAccessKey());
    }

    /**
     * Tests setting and getting the timeout.
     */
    public function testSetAndGetTimeout()
    {
        $options = new Options();
        $this->assertEquals($options, $options->setTimeout(42));
        $this->assertEquals(42, $options->getTimeout());
    }
}
