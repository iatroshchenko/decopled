<?php

declare(strict_types=1);

use Slim\App;
use DI\Container;

return function (App $app, Container $container) {
    $app->addErrorMiddleware($container->get('config')['debug'], true, true);
};