<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\Api\Client\Serializer\ExclusionStrategy;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\Api\Client\Transfer\Entity;
use FactorioItemBrowser\Api\Client\Transfer\Item;
use FactorioItemBrowser\Api\Client\Transfer\Machine;
use FactorioItemBrowser\Api\Client\Transfer\Recipe;
use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy\ConstantTypeExclusionStrategy;
use JMS\Serializer\Context;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ConstantTypeExclusionStrategy class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy\ConstantTypeExclusionStrategy
 */
class ConstantTypeExclusionStrategyTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Provides the data for the shouldSkipClass test.
     * @return array<mixed>
     */
    public function provideShouldSkipClass(): array
    {
        return [
            [Entity::class, false],
            [Item::class, false],
            [Machine::class, true],
            [Recipe::class, true],
            [RecipeWithExpensiveVersion::class, true],
        ];
    }

    /**
     * Tests the shouldSkipClass method.
     * @param class-string $className
     * @param bool $expectedIsCurrentlyExcluded
     * @throws ReflectionException
     * @covers ::shouldSkipClass
     * @dataProvider provideShouldSkipClass
     */
    public function testShouldSkipClass($className, bool $expectedIsCurrentlyExcluded): void
    {
        $metaData = new ClassMetadata($className);

        /* @var Context&MockObject $context */
        $context = $this->createMock(Context::class);

        $strategy = new ConstantTypeExclusionStrategy();
        $result = $strategy->shouldSkipClass($metaData, $context);

        $this->assertFalse($result);
        $this->assertSame($expectedIsCurrentlyExcluded, $this->extractProperty($strategy, 'isCurrentlyExcluded'));
    }

    /**
     * Provides the data for the shouldSkipProperty test.
     * @return array<mixed>
     */
    public function provideShouldSkipProperty(): array
    {
        return [
            [false, 'abc', false],
            [true, 'abc', false],
            [false, 'type', false],
            [true, 'type', true],
        ];
    }

    /**
     * Tests the shouldSkipProperty method.
     * @param bool $isCurrentlyExcluded
     * @param string $propertyName
     * @param bool $expectedResult
     * @throws ReflectionException
     * @covers ::shouldSkipProperty
     * @dataProvider provideShouldSkipProperty
     */
    public function testShouldSkipProperty(bool $isCurrentlyExcluded, string $propertyName, bool $expectedResult): void
    {
        $metaData = new PropertyMetadata('foo', $propertyName);

        /* @var Context&MockObject $context */
        $context = $this->createMock(Context::class);

        $strategy = new ConstantTypeExclusionStrategy();
        $this->injectProperty($strategy, 'isCurrentlyExcluded', $isCurrentlyExcluded);

        $result = $strategy->shouldSkipProperty($metaData, $context);
        $this->assertSame($expectedResult, $result);
    }
}
