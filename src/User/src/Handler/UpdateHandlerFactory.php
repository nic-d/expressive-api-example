<?php

declare(strict_types=1);

namespace User\Handler;

use Psr\Container\ContainerInterface;

class UpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : UpdateHandler
    {
        return new UpdateHandler();
    }
}
