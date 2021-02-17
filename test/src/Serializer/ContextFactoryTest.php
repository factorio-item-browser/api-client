<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer;

use FactorioItemBrowser\Api\Client\Serializer\ContextFactory;
use FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy\ConstantTypeExclusionStrategy;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ContextFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Serializer\ContextFactory
 */
class ContextFactoryTest extends TestCase
{
    public function testCreateSerializationContext(): void
    {
        $instance = new ContextFactory();
        $result = $instance->createSerializationContext();

        $this->assertInstanceOf(ConstantTypeExclusionStrategy::class, $result->getExclusionStrategy());
    }
}
