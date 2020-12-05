<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

/*
 * Desktop route configuration
 */
$homepage = new RouterGroup([
    'module' => 'Homepage',
    'namespace' => 'App\Modules\Homepage\Controllers',
]);

$homepage->add('/',[
    'controller' => 'index'
]);

/*
 * Mount desktop router to router service
 */
$router->mount($homepage);
