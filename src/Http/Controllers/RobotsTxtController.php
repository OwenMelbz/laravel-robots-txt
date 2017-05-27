<?php

namespace OwenMelbz\RobotsTxt\Http\Controllers;

use OwenMelbz\RobotsTxt\RobotsTxt;
use Illuminate\Routing\Controller;

class RobotsTxtController extends Controller {

    public function txt()
    {
        $output = (new RobotsTxt)->generate();

        header('Content-Type: text/plain; charset=utf-8');
        exit($output);
    }
}
