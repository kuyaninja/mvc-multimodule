<?php
declare(strict_types=1);

$httpHost = $_SERVER['HTTP_HOST'];

$router = new \Phalcon\Mvc\Router(false);
$router->setDefaultModule('Homepage');
include APP_PATH . "/apps/Modules/Homepage/Config/routes.php";
$router->addGet(
    '/assets/(css|js)/([\w.-]+)\.(css|js)',
    [
        'namespace'  => 'App\Modules\Common\Controllers',
        'controller' => 'assets',
        'action'     => 'serve',
        'type'       => 1,
        'collection' => 2,
        'extension'  => 3,
    ]
);

$di->set('router', $router);