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
 * Class CreateHandlerFactory
 * @package User\Handler
 */
class CreateHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return CreateHandler
     */
    public function __invoke(ContainerInterface $container) : CreateHandler
    {
        $userService        = $container->get(UserService::class);
        $userFilter         = $container->get('InputFilterManager')->get(UserFilter::class);
        $resourceGenerator  = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);
        $problemDetailsResponseFactory = $container->get(ProblemDetailsResponseFactory::class);

        return new CreateHandler(
            $userService,
            $userFilter,
            $resourceGenerator,
            $halResponseFactory,
            $problemDetailsResponseFactory
        );
    }
}
