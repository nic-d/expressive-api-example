<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'invokables' => [],
        'aliases' => [],

        'factories' => [
            'doctrine.entity_manager.orm_default' => ContainerInteropDoctrine\EntityManagerFactory::class,
        ],

        'delegators' => [
            Zend\Expressive\Application::class => [
                Zend\Expressive\Container\ApplicationConfigInjectionDelegator::class,
            ],
        ],
    ],
];
