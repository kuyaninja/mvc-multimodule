<?php
declare(strict_types=1);

$dotenv = Dotenv\Dotenv::createImmutable(APP_PATH . '/');
$dotenv->load();

function env($name, $default = null)
{
    return (getenv($name)) ?: $default;
}

if (env('APP_ENV') == 'dev') {
    error_reporting(E_ALL);

    $debug = new \Phalcon\Debug();
    $debug->listen();
}