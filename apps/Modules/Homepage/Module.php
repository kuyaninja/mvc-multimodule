<?php
declare(strict_types=1);

namespace App\Modules\Homepage;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use App\Library\PhpFunctionExtension;
use Phalcon\Mvc\ViewBaseInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * @var \Phalcon\Di\DiInterface
     */
    protected $di;

    public function registerServices(\Phalcon\Di\DiInterface $container)
    {
        $this->di = $container;
        /**
         * Read configuration
         */
        if (!empty($di['config'])) {
            $config = $di['config']->merge(include __DIR__ . "/Config/config.php");
        } else {
            $config = include __DIR__ . "/Config/config.php";
        }

        /**
         * Setting up the view component
         */
        $this->di["view"] = function () use ($config) {
            $view = new View();
            $view->setViewsDir($config->viewDir);
            $view->registerEngines(
                [
                    '.volt' => function (ViewBaseInterface $view) use ($config) {
                        $volt = new VoltEngine($view, $this->di);
                        if (!is_dir($config->viewCacheDir)) {
                            mkdir($config->viewCacheDir, 0755, true);
                        }
                        $volt->setOptions([
                            'path' => $config->viewCacheDir,
                            'separator' => '_',
                            'stat' => true,
                            'always' => $config->viewAlwaysCompile
                        ]);
                        $compiler = $volt->getCompiler();
                        $compiler->addExtension(new PhpFunctionExtension());

                        return $volt;
                    },
                ]
            );

            return $view;
        };

        $this->di['assets']
            ->useImplicitOutput(false)
            ->collection('homepage')
            ->addCss(__DIR__ . '/Assets/Css/starter-template.css', true, true)
            ->setTargetPath('/assets/css/homepage.css')
            ->setTargetUri('/assets/css/homepage.css')
        ;
    }

    public function registerAutoloaders(\Phalcon\Di\DiInterface $container = null)
    {
        // TODO: Implement registerAutoloaders() method.
    }
}