<?php
declare(strict_types=1);

$httpHost = $_SERVER['HTTP_HOST'];

$router = new \Phalcon\Mvc\Router(false);
$router->setDefaultModule('Homepage');
include APP_PATH . "/apps/Modules/Homepage/Config/routes.php";

$di->set('router', $router);