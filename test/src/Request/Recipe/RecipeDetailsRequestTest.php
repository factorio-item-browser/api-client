<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Request\Recipe;

use FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest;
use PHPUnit\Framework\TestCase;

/**
 * The PHPunit test of the recipe details request class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Request\Recipe\RecipeDetailsRequest
 */
class RecipeDetailsRequestTest extends TestCase
{
    /**
     * Tests the setting and getting the names.
     * @covers ::addName
     * @covers ::getNames
     * @covers ::setNames
     */
    public function testSetAddAndGetNames(): void
    {
        $names = ['abc', 'def'];
        $request = new RecipeDetailsRequest();

        $this->assertSame($request, $request->setNames($names));
        $this->assertSame($names, $request->getNames());
        $this->assertSame($request, $request->addName('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $request->getNames());
    }
}
