<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => getenv('DATABASE_HOST') ?: '',
                    'port'     => getenv('DATABASE_PORT') ?: '',
                    'user'     => getenv('DATABASE_USER') ?: '',
                    'password' => getenv('DATABASE_PASS') ?: '',
                    'dbname'   => getenv('DATABASE_NAME') ?: '',
                ],
            ],
        ],

        'driver' => [
            'orm_default' => [
                'class' => Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
            ],
        ],

        'types' => [
            Ramsey\Uuid\Doctrine\UuidType::NAME => Ramsey\Uuid\Doctrine\UuidType::class,
        ],
    ],
];
