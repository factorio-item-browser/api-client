<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Request;

use JMS\Serializer\Annotation\Exclude;

/**
 * The abstract class of all requests.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
abstract class AbstractRequest
{
    /**
     * The ID of the combination to use for the request.
     */
    #[Exclude]
    public string $combinationId = '';

    /**
     * The language code to use for translating labels and descriptions.
     */
    #[Exclude]
    public string $locale = '';
}
