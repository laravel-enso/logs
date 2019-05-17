<?php

namespace LaravelEnso\Logs\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\app\Services\Destroyer;

class Destroy extends Controller
{
    public function __invoke($filename)
    {
        $log = (new Destroyer($filename))->handle();

        return [
            'log' => $log,
            'message' => __('The log was cleaned'),
        ];
    }
}
