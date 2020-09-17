<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $app = AppFactory::createFromContainer($container);

    (require __DIR__ . '/middleware.php')($app, $container);
    (require __DIR__ . '/routes.php')($app);

    return $app;
};
