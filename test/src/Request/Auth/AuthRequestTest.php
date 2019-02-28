<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the auth request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest
 */
class AuthRequestTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $request = new AuthRequest();

        $this->assertSame('', $request->getAgent());
        $this->assertSame('', $request->getAccessKey());
        $this->assertSame([], $request->getEnabledModNames());
    }

    /**
     * Tests the setting and getting the agent.
     * @covers ::getAgent
     * @covers ::setAgent
     */
    public function testSetAndGetAgent(): void
    {
        $agent = 'abc';
        $request = new AuthRequest();

        $this->assertSame($request, $request->setAgent($agent));
        $this->assertSame($agent, $request->getAgent());
    }

    /**
     * Tests the setting and getting the access key.
     * @covers ::getAccessKey
     * @covers ::setAccessKey
     */
    public function testSetAndGetAccessKey(): void
    {
        $accessKey = 'abc';
        $request = new AuthRequest();

        $this->assertSame($request, $request->setAccessKey($accessKey));
        $this->assertSame($accessKey, $request->getAccessKey());
    }

    /**
     * Tests the setting and getting the enabled mod names.
     * @covers ::getEnabledModNames
     * @covers ::setEnabledModNames
     */
    public function testSetAndGetEnabledModNames(): void
    {
        $enabledModNames = ['abc', 'def'];
        $request = new AuthRequest();

        $this->assertSame($request, $request->setEnabledModNames($enabledModNames));
        $this->assertSame($enabledModNames, $request->getEnabledModNames());
    }
}
