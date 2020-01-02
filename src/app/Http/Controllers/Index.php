<?php

namespace LaravelEnso\Logs\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\App\Services\Collection;

class Index extends Controller
{
    public function __invoke()
    {
        return (new Collection())->get();
    }
}
