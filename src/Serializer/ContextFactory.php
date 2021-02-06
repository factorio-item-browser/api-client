<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Serializer;

use FactorioItemBrowser\Api\Client\Serializer\ExclusionStrategy\ConstantTypeExclusionStrategy;
use JMS\Serializer\ContextFactory\SerializationContextFactoryInterface;
use JMS\Serializer\SerializationContext;

/**
 * The factory of the context class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ContextFactory implements SerializationContextFactoryInterface
{
    public function createSerializationContext(): SerializationContext
    {
        $context = new SerializationContext();
        $context->addExclusionStrategy(new ConstantTypeExclusionStrategy());
        return $context;
    }
}
