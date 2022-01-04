<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Transfer;

/**
 * The class representing a generic entity holding basic information including translations.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class GenericEntity extends Entity
{
    /**
     * The translated label of the entity.
     */
    public string $label = '';

    /**
     * The translated description of the entity.
     */
    public string $description = '';
}
