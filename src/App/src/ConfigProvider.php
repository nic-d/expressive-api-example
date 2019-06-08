<?php

declare(strict_types=1);

namespace App;

/**
 * Class ConfigProvider
 * @package App
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],

            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
        ];
    }
}
