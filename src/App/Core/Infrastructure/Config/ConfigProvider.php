<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Config;

use Doctrine\ORM\EntityManager;
use App\Core\Infrastructure\Factory\EntityFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'doctrine' => [
                'metadata' => [
                    __DIR__ . '/../Persistence/Doctrine/Metadata',
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                EntityManager::class => EntityFactory::class,
            ],
        ];
    }
}
