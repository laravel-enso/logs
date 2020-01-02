<?php

namespace LaravelEnso\Logs\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\App\Services\Presenter;

class Show extends Controller
{
    public function __invoke(string $filename)
    {
        return (new Presenter($filename))->get();
    }
}
