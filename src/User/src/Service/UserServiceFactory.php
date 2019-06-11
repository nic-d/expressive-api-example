<?php

declare(strict_types=1);

namespace User\Service;

use User\Hydrator\UserHydrator;
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
        $userHydrator  = $container->get(UserHydrator::class);

        return new UserService($entityManager, $userHydrator);
    }
}
