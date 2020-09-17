<?php

declare(strict_types=1);

use Slim\App;
use Psr\Container\ContainerInterface;

return function (App $app, ContainerInterface $container) {
    $config = $container->get('config');
    assert(is_array($config));
    assert(is_bool($config['debug']));

    $app->addErrorMiddleware($config['debug'], true, true);
};
