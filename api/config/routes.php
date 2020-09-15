<?php

declare(strict_types=1);

use Slim\App;
use App\Action\IndexAction;

return function (App $app): void {
    $app->get('/', IndexAction::class);
};
