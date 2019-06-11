<?php

declare(strict_types=1);

namespace User\Service;

use Psr\Container\ContainerInterface;

/**
 * Class UserServiceFactory
 * @package User\Service
 */
class UserServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserService
     */
    public function __invoke(ContainerInterface $container) : UserService
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new UserService($entityManager);
    }
}
