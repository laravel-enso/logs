<?php

namespace LaravelEnso\LogManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use LaravelEnso\LogManager\app\Http\Services\LogService;

class LogController extends Controller
{
    private $logs;

    public function __construct()
    {
        $this->logs = new LogService();
    }
    public function index()
    {
        return $this->logs->index();
    }

    public function show(string $fileName)
    {
        return $this->logs->show($fileName);
    }

    public function download($fileName)
    {
        return $this->logs->download($fileName);
    }

    public function destroy($fileName)
    {
        return $this->logs->empty($fileName);
    }
}
