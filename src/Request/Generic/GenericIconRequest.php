<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request\Generic;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;
use FactorioItemBrowser\Api\Client\Transfer\Entity;
use JMS\Serializer\Annotation\Type;

/**
 * The request of icons for entities.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericIconRequest extends AbstractRequest
{
    /**
     * The entities to request the icon for.
     * @var array<Entity>
     */
    #[Type('array<' . Entity::class . '>')]
    public array $entities = [];
}
