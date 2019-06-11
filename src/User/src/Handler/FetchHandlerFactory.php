<?php

declare(strict_types=1);

namespace User\Handler;

use Psr\Container\ContainerInterface;

class FetchHandlerFactory
{
    public function __invoke(ContainerInterface $container) : FetchHandler
    {
        return new FetchHandler();
    }
}
