<?php
declare(strict_types=1);

use Phalcon\Config;

defined('APP_PATH') || define('APP_PATH', realpath('.'));

// Check subdomain
$httpHost = $_SERVER['HTTP_HOST'];
$subdomainArr = explode(".", $httpHost);
$subdomain = reset($subdomainArr);

// Define BASE_URL constant
if (empty($subdomain) || $subdomain == 'www') {
    define('BASE_URL', env('APP_PUBLIC_URL'));
} else {
    $appPublicUrl = "//" . $subdomain . "." . env('APP_BASE_DOMAIN', 'mbiz.co.id');
    define('BASE_URL', $appPublicUrl);
}

define('CURRENT_BASE_URL', (strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http').'://'.$_SERVER['HTTP_HOST']);

return new Config(
    [
        'redis' => [
            'session' => [
                'host'     => env('REDIS_SESSION_HOST'),
                'port'     => env('REDIS_SESSION_PORT'),
                'database' => env('REDIS_SESSION_DB'),
                'timeout'  => env('REDIS_SESSION_TIMEOUT'),
            ],
            'cache' => [
                'host'     => env('REDIS_CACHE_HOST'),
                'port'     => env('REDIS_CACHE_PORT'),
                'database' => env('REDIS_CACHE_DB'),
                'timeout'  => env('REDIS_CACHE_TIMEOUT'),
            ],
            'static' => [
                'host'     => env('REDIS_STATIC_HOST'),
                'port'     => env('REDIS_STATIC_PORT'),
                'database' => env('REDIS_STATIC_DB'),
                'timeout'  => env('REDIS_STATIC_TIMEOUT'),
            ],
        ],
        'application' => [
            'name'              => 'App',
            'baseUri'           => '/',
            'environment'       => env('APP_ENV', 'dev'), // dev or production
            'assetVersion'      => '0.1', // update asset version if any changes were made to css or js assetsjs assets
            'publicUrl'         => env('APP_PUBLIC_URL', 'http://127.0.0.1'),
            'imageServerUrl'    => env('APP_IMAGE_SERVER', 'http://localhost'),
            'baseUrl'           => env('APP_BASE_URL','localhost'),
            'viewAlwaysCompile' => env('VIEW_ALWAYS_COMPILE', "true") == "true",
            'cookie_domain'     => env('APP_COOKIE_DOMAIN', '.localhost'),
            'cryptSecretKey'    => env('APP_CRYPT_SECRET_KEY'),
            //'fullPageCache'     => (env('FULL_PAGE_CACHE', "true") == "true") ? true : false,
            'cacheEnabled'      => strtolower(env('CACHE_ENABLED', "true")),
        ],
        'tiny' => [
            'app_id' => env('API_APP_ID'),
            'app_secret' => env('API_APP_SECRET'),
            'host' => env('APP_API_URL', 'http://api.mbiz.co.id'),
            'hmac' => [
                'num-first-iterations' => 10,
                'num-second-iterations' => 10,
                'num-final-iterations' => 10
            ]
        ],
        'recaptcha' => [
            'public_key' => env('RECAPTCHA_PUBLIC_KEY', 'trililiilil'),
            'secret_key' => env('RECAPTCHA_SECRET_KEY', 'trololololol')
        ],
        'emails' => [
            'help' => env('EMAIL_HELP', 'help@mbiz.co.id')
        ]
    ]
);