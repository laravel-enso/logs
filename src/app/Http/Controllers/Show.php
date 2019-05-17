<?php

namespace LaravelEnso\Logs\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\app\Services\Presenter;

class Show extends Controller
{
    public function __invoke(string $filename)
    {
        return (new Presenter($filename))->get();
    }
}
