<?php

namespace LaravelEnso\Logs\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\app\Services\Collection;

class Index extends Controller
{
    public function __invoke()
    {
        return (new Collection())->get();
    }
}
