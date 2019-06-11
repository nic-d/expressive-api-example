<?php

declare(strict_types=1);

namespace User;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

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
            'routes'       => $this->getRoutes(),
            'doctrine'     => $this->getDoctrine(),
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

    /**
     * @return array
     */
    public function getRoutes() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getDoctrine() : array
    {
        return [
            'driver' => [
                'user_driver' => [
                    'class' => AnnotationDriver::class,
                    'cache' => 'array',
                    'paths' => __DIR__ . '/Entity',
                ],

                'orm_default' => [
                    'drivers' => [
                        'User\Entity' => 'user_driver',
                    ],
                ],
            ],
        ];
    }
}
