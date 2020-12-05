<?php
declare(strict_types=1);

use Phalcon\Mvc\Application;

date_default_timezone_set('Asia/Jakarta');

define('APP_PATH', __DIR__ . '/..');

try {
    /**
     * Read vendors
     */
    require_once APP_PATH . "/vendor/autoload.php";

    /**
     * Starting Up...
     */
    include_once APP_PATH . "/config/startup.php";


    /**
     * Read auto-loader
     */
    include APP_PATH . "/config/loader.php";


    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";

    /**
     * Handle the request
     * @var $di
     */
    $application = new Application($di);

    /**
     * Run events
     * Declare $eventManager $dispatcher
     */
    include APP_PATH . "/config/events.php";

    /**
     * Read modules
     */
    include APP_PATH . "/config/modules.php";

    /**
     * Read routes
     */
    include APP_PATH . "/config/routes.php";

    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();

} catch (\Exception $e) {
    echo get_class($e), ": ", $e->getMessage(), "\n";
    echo " File=", $e->getFile(), "\n";
    echo " Line=", $e->getLine(), "\n";
    echo $e->getTraceAsString();
}