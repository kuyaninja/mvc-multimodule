<?php


namespace App\Helper;


class GlobalHelper
{
    public static function getBaseUrl()
    {
        $httpHost = $_SERVER['HTTP_HOST'];
        $subdomainArr = explode(".", $httpHost);
        $subdomain = reset($subdomainArr);

        if (!empty($subdomain) && $subdomain !== 'www') {
            return "//" . $subdomain . "." . env('APP_BASE_DOMAIN', '127.0.0.1');
        } else {
            return env('APP_PUBLIC_URL');
        }
    }
}