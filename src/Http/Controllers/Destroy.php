<?php

namespace LaravelEnso\Logs\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\Services\ClearLog;

class Destroy extends Controller
{
    public function __invoke($filename)
    {
        $log = (new ClearLog($filename))->handle();

        return [
            'log' => $log,
            'message' => __('The log was cleaned'),
        ];
    }
}
