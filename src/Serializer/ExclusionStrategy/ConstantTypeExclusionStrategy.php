<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy;

use FactorioItemBrowser\Api\Client\Transfer\Machine;
use FactorioItemBrowser\Api\Client\Transfer\Mod;
use FactorioItemBrowser\Api\Client\Transfer\Recipe;
use FactorioItemBrowser\Api\Client\Transfer\RecipeWithExpensiveVersion;
use JMS\Serializer\Context;
use JMS\Serializer\Exclusion\ExclusionStrategyInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;

/**
 * The exclusion strategy for the type which has a constant value.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ConstantTypeExclusionStrategy implements ExclusionStrategyInterface
{
    /**
     * The entities from which the type should be excluded.
     */
    protected const EXCLUDED_ENTITIES = [
        Machine::class,
        Mod::class,
        Recipe::class,
        RecipeWithExpensiveVersion::class,
    ];

    /**
     * Whether the type is excluded for the currently processed entity.
     * @var boolean
     */
    protected $isCurrentlyExcluded = false;

    /**
     * Whether the class should be skipped.
     * @param ClassMetadata $metadata
     * @param Context $context
     * @return bool
     */
    public function shouldSkipClass(ClassMetadata $metadata, Context $context): bool
    {
        $this->isCurrentlyExcluded = in_array($metadata->name, self::EXCLUDED_ENTITIES, true);
        return false;
    }

    /**
     * Whether the property should be skipped.
     * @param PropertyMetadata $property
     * @param Context $context
     * @return bool
     */
    public function shouldSkipProperty(PropertyMetadata $property, Context $context): bool
    {
        return $property->name === 'type' && $this->isCurrentlyExcluded;
    }
}
