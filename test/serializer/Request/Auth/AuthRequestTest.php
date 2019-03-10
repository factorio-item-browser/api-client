<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Request\Auth;

use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowserTestAsset\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the AuthRequest class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class AuthRequestTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $result = new AuthRequest();
        $result->setAgent('abc')
               ->setAccessKey('def')
               ->setEnabledModNames(['ghi', 'jkl']);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'agent' => 'abc',
            'accessKey' => 'def',
            'enabledModNames' => ['ghi', 'jkl'],
        ];
    }
}