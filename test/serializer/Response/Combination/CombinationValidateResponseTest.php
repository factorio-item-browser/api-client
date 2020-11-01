<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\Api\Client\Response\Combination;

use FactorioItemBrowser\Api\Client\Entity\ValidatedMod;
use FactorioItemBrowser\Api\Client\Response\Combination\CombinationValidateResponse;
use FactorioItemBrowserTestSerializer\Api\Client\SerializerTestCase;

/**
 * The PHPUnit test of serializing the CombinationValidateResponse class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversNothing
 */
class CombinationValidateResponseTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $validatedMod1 = new ValidatedMod();
        $validatedMod1->setName('abc')
                      ->setVersion('1.2.3')
                      ->setIssueType('def')
                      ->setIssueDependency('ghi');

        $validatedMod2 = new ValidatedMod();
        $validatedMod2->setName('jkl')
                      ->setVersion('2.3.4')
                      ->setIssueType('mno')
                      ->setIssueDependency('pqr');

        $result = new CombinationValidateResponse();
        $result->setIsValid(true)
               ->setValidatedMods([$validatedMod1, $validatedMod2]);
        return $result;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'isValid' => true,
            'validatedMods' => [
                [
                    'name' => 'abc',
                    'version' => '1.2.3',
                    'issueType' => 'def',
                    'issueDependency' => 'ghi',
                ],
                [
                    'name' => 'jkl',
                    'version' => '2.3.4',
                    'issueType' => 'mno',
                    'issueDependency' => 'pqr',
                ],
            ],
        ];
    }
}
