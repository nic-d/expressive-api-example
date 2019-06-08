<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var Dotenv\Dotenv $dotenv */
$dotenv = Dotenv\Dotenv::create(getcwd());
$dotenv->load();

(function () {
    /** @var Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var Symfony\Component\Console\Application $app */
    $app = new Symfony\Component\Console\Application('Expressive API Example', '1.0');

    // We need to add the EM to the helper set
    $app->setHelperSet(new Symfony\Component\Console\Helper\HelperSet([
        'em' => new Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper(
            $container->get('doctrine.entity_manager.orm_default')
        ),
    ]));

    // Register all the Doctrine console commands
    Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($app);

    // Register all of our console commands
    foreach ($container->get('config')['console'] as $command) {
        $app->add($container->get($command));
    }

    $app->run();
})();
