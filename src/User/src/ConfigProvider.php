<?php

declare(strict_types=1);

namespace User;

/**
 * Class ConfigProvider
 * @package User
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
            'factories' => [
            ],
        ];
    }
}
