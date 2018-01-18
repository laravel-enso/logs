<?php

namespace LaravelEnso\LogManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\LogManager\app\Handlers\Presenter;
use LaravelEnso\LogManager\app\Handlers\Destroyer;
use LaravelEnso\LogManager\app\Handlers\Collection;

class LogController extends Controller
{
    public function index()
    {
        return ['logs' => (new Collection())->get()];
    }

    public function show(string $filename)
    {
        return ['log' => (new Presenter($filename))->get()];
    }

    public function download($filename)
    {
        $headers = ['Content-Type: application/log'];

        return response()->download(
            storage_path('logs/'.$filename),
            $filename,
            $headers
        );
    }

    public function destroy($filename)
    {
        $log = (new Destroyer($filename))->run();

        return [
            'log' => $log,
            'message' => __('The log was cleaned')
        ];
    }
}
