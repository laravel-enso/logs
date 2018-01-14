<?php

namespace LaravelEnso\LogManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\LogManager\app\Http\Services\LogService;

class LogController extends Controller
{
    public function index(LogService $service)
    {
        return $service->index();
    }

    public function show(string $fileName, LogService $service)
    {
        return $service->show($fileName);
    }

    public function download($fileName, LogService $service)
    {
        return $service->download($fileName);
    }

    public function destroy($fileName, LogService $service)
    {
        return $service->empty($fileName);
    }
}
