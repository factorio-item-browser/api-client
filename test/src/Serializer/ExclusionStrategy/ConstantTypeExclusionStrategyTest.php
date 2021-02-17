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
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ConstantTypeExclusionStrategy class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy\ConstantTypeExclusionStrategy
 */
class ConstantTypeExclusionStrategyTest extends TestCase
{
    use ReflectionTrait;

    /**
     * @return array<mixed>
     */
    public function provideShouldSkip(): array
    {
        return [
            [Entity::class, 'name', false],
            [Entity::class, 'type', false],
            [Item::class, 'name', false],
            [Item::class, 'type', false],
            [Machine::class, 'name', false],
            [Machine::class, 'type', true],
            [Recipe::class, 'name', false],
            [Recipe::class, 'type', true],
            [RecipeWithExpensiveVersion::class, 'name', false],
            [RecipeWithExpensiveVersion::class, 'type', true],
        ];
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @param bool $expectedResult
     * @dataProvider provideShouldSkip
     */
    public function testShouldSkip(string $className, string $propertyName, bool $expectedResult): void
    {
        $classMetaData = new ClassMetadata($className);
        $propertyMetaData = new PropertyMetadata('foo', $propertyName);

        $context = $this->createMock(Context::class);

        $instance = new ConstantTypeExclusionStrategy();
        $this->assertFalse($instance->shouldSkipClass($classMetaData, $context));
        $this->assertSame($expectedResult, $instance->shouldSkipProperty($propertyMetaData, $context));
    }
}
