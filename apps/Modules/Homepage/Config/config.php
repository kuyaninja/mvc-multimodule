<?php
declare(strict_types=1);

use Phalcon\Config;

return new Config(
    [
        "viewDir" => APP_PATH . "/apps/Modules/Homepage/Views",
        "viewCacheDir" => __DIR__ . "/../cache/views/homepage/",
        "viewAlwaysCompile" => env("VIEW_ALWAYS_COMPILE") == "true",
    ]
);