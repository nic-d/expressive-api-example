<?php

declare(strict_types=1);

namespace User\Handler;

use User\Filter\UserFilter;
use User\Service\UserService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

/**
 * Class UpdateHandlerFactory
 * @package User\Handler
 */
class UpdateHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return UpdateHandler
     */
    public function __invoke(ContainerInterface $container) : UpdateHandler
    {
        $userService        = $container->get(UserService::class);
        $userFilter         = $container->get('InputFilterManager')->get(UserFilter::class);
        $resourceGenerator  = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);
        $problemDetailsResponseFactory = $container->get(ProblemDetailsResponseFactory::class);

        return new UpdateHandler(
            $userService,
            $userFilter,
            $resourceGenerator,
            $halResponseFactory,
            $problemDetailsResponseFactory
        );
    }
}
