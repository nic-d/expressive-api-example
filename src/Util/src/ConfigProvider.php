<?php

declare(strict_types=1);

namespace Util;

/**
 * Class ConfigProvider
 * @package Util
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
            'factories' => [],
        ];
    }
}
