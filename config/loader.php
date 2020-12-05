<?php
declare(strict_types=1);

$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    'App' => APP_PATH . "/apps/",
]);

$loader->register();