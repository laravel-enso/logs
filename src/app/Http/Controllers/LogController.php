<?php

namespace LaravelEnso\LogManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\LogManager\app\Http\Services\LogService;

class LogController extends Controller
{
    private $service;

    public function __construct(LogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(string $fileName)
    {
        return $this->service->show($fileName);
    }

    public function download($fileName)
    {
        return $this->service->download($fileName);
    }

    public function destroy($fileName)
    {
        return $this->service->empty($fileName);
    }
}
