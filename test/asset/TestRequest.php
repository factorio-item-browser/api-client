<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestAsset\Api\Client;

use FactorioItemBrowser\Api\Client\Request\AbstractRequest;

/**
 * A request class for testing.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TestRequest extends AbstractRequest
{
    public string $foo = 'foo';
}
