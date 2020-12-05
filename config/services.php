<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Url as UrlResolver;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Session\Manager;
use Phalcon\Storage\SerializerFactory;
use Phalcon\Cache\Adapter\Stream as CacheStream;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Syslog;
use Phalcon\Http\Request;
use Phalcon\Mvc\View\Engine\Volt;

/**
 * Read the configuration
 */
$config = include __DIR__ . "/config.php";

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Set configuration to DI so it could be called everywhere
 */
$di->setShared('config', $config);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->set(
    'view',
    function () {
        $view = new View();

        $view->setViewsDir('../apps/views/');
        $view->registerEngines(
            [
                '.volt' => function (ViewBaseInterface $view) {
                    $volt = new Volt($view, $this);

                    $volt->setOptions(
                        [
                            'always'    => true,
                            'extension' => '.php',
                            'separator' => '_',
                            'stat'      => true,
                            'path'      => APP_PATH . 'storage/cache/volt/',
                            'prefix'    => '-prefix-',
                        ]
                    );

                    return $volt;
                }
            ]
        );

        return $view;
    }
);


/**
 * Set session service
 */
$di->setShared('session', function () use ($config) {

    $session = new Manager();
    $files = new Stream(
        [
            'savePath' => '/tmp',
        ]
    );
    $session->setAdapter($files);

    $session->start();

    return $session;
});

/**
 * Static data
 */
$di->setShared('cache', function () use ($config) {
    $serializerFactory = new SerializerFactory();

    $options = [
        'defaultSerializer' => 'Json',
        'lifetime' => 7200,
        'storageDir' => $config->application->cachepath,
    ];

    return new CacheStream($serializerFactory, $options);
});

$di->setShared('log', function () use ($config) {
    $adapter = new Syslog(
        'ident-name',
        [
            'option' => LOG_NDELAY,
            'facility' => LOG_MAIL,
        ]
    );

    return new Logger(
        'messages',
        [
            'main' => $adapter,
        ]
    );
});

$di->setShared(
    "request",
    function () {
        return new Request();
    }
);