<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$dependencies = require __DIR__ . '/dependencies.php';

return (new ContainerBuilder())
    ->addDefinitions($dependencies)
    ->build();
