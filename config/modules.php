<?php
declare(strict_types=1);

/**
 * Register application modules
 */

$application->registerModules(
    [
        "Homepage" => [
            "className" => "App\Modules\Homepage\Module",
            "path"      => APP_PATH . "/apps/Modules/Homepage/Module.php",
        ],
    ]
);