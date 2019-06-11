<?php

declare(strict_types=1);

namespace User\Handler;

use User\Service\UserService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

/**
 * Class FetchHandlerFactory
 * @package User\Handler
 */
class FetchHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return FetchHandler
     */
    public function __invoke(ContainerInterface $container) : FetchHandler
    {
        $userService        = $container->get(UserService::class);
        $resourceGenerator  = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);
        $problemDetailsResponseFactory = $container->get(ProblemDetailsResponseFactory::class);

        return new FetchHandler(
            $userService,
            $resourceGenerator,
            $halResponseFactory,
            $problemDetailsResponseFactory
        );
    }
}
