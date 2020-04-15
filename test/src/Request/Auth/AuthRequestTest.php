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

        $this->assertSame('', $request->getAccessKey());
        $this->assertSame([], $request->getModNames());
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
     * Tests the setting and getting the mod names.
     * @covers ::getModNames
     * @covers ::setModNames
     */
    public function testSetAndGetModNames(): void
    {
        $modNames = ['abc', 'def'];
        $request = new AuthRequest();

        $this->assertSame($request, $request->setModNames($modNames));
        $this->assertSame($modNames, $request->getModNames());
    }
}
