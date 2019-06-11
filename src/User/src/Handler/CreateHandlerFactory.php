<?php

declare(strict_types=1);

namespace User\Handler;

use Psr\Container\ContainerInterface;

class CreateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateHandler
    {
        return new CreateHandler();
    }
}
