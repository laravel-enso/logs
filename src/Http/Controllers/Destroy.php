<?php

namespace LaravelEnso\Logs\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\App\Services\ClearLog;

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
