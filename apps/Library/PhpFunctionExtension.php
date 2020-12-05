<?php
declare(strict_types=1);

namespace App\Library;

class PhpFunctionExtension
{
    /**
     * This method is called on any attempt to compile a function call
     * @param $name
     * @param $arguments
     */
    public function compileFunction($name, $arguments)
    {
        switch ($name) {
            case 'base_url':
                return 'App\Helper\GlobalHelper::getBaseUrl()';
            default:
                if (function_exists($name)) { return $name . '('. $arguments . ')'; }
        }
    }
}