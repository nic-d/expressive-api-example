<?php

declare(strict_types=1);

namespace User\Middleware;

use User\Service\UserService;
use Psr\Container\ContainerInterface;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

/**
 * Class UserFetchMiddlewareFactory
 * @package User\Middleware
 */
class UserFetchMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserFetchMiddleware
     */
    public function __invoke(ContainerInterface $container) : UserFetchMiddleware
    {
        $userService = $container->get(UserService::class);
        $problemDetailsResponseFactory = $container->get(ProblemDetailsResponseFactory::class);

        return new UserFetchMiddleware($userService, $problemDetailsResponseFactory);
    }
}
