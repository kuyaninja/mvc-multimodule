<?php
declare(strict_types=1);

namespace App\Modules\Common\Controllers;


use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{

    protected $bootstrapCss;

    protected $bootstrapJs;


    public function initialize()
    {
        $this->view->BASE_URL = BASE_URL;
        $this->response = new Response;
        $this->setupBootstrap();
    }

    public function setupBootstrap()
    {
        $this->bootstrapCss = __DIR__ . '/../Assets/dist/css/';
        $this->bootstrapJs = __DIR__ . '/../Assets/dist/js/';

        $this
            ->assets
            ->useImplicitOutput(false)
            ->collection('bootstrapCss')
            ->addCss($this->bootstrapCss . 'bootstrap.css', false, true)
            ->setTargetPath('/assets/css/bootstrapCss.css')
            ->setTargetUri('/assets/css/bootstrapCss.css')
        ;

        $this
            ->assets
            ->useImplicitOutput(false)
            ->collection('bootstrapBundleJs')
            ->addJs($this->bootstrapJs . 'bootstrap.bundle.js', false, true)
            ->setTargetPath('/assets/js/bootstrapBundleJs.js')
            ->setTargetUri('/assets/js/bootstrapBundleJs.js')
        ;

        $css = '
            .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
        ';

        $this
            ->assets
            ->addInlineCss($css);
    }
}