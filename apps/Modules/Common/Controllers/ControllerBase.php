<?php
declare(strict_types=1);

namespace App\Modules\Common\Controllers;


use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{

    public function initialize()
    {
        $this->view->BASE_URL = BASE_URL;
        $this->response = new Response;
    }
}