<?php
declare(strict_types=1);


$eventsManager = $di->get('eventsManager');

/**
 * Full page cache.
 */
//if ($config->application->cacheEnabled === "true") {
//    $eventsManager->attach('application', new FullCachePlugin);
//}

$application->setEventsManager($eventsManager);