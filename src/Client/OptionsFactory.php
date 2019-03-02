<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Client;

use FactorioItemBrowser\Api\Client\Constant\ConfigKey;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory of the options.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class OptionsFactory implements FactoryInterface
{
    /**
     * Creates the options.
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return Options
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Options
    {
        $config = $container->get('config');
        $optionsConfig = $config[ConfigKey::PROJECT][ConfigKey::LIBRARY][ConfigKey::OPTIONS] ?? [];

        $result = new Options();
        $result->setApiUrl($optionsConfig[ConfigKey::OPTION_API_URL])
               ->setAgent($optionsConfig[ConfigKey::OPTION_AGENT])
               ->setAccessKey($optionsConfig[ConfigKey::OPTION_ACCESS_KEY])
               ->setTimeout($optionsConfig[ConfigKey::OPTION_TIMEOUT]);

        return $result;
    }
}
