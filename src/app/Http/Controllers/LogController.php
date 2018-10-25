<?php

namespace LaravelEnso\LogManager\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\LogManager\app\Classes\Destroyer;
use LaravelEnso\LogManager\app\Classes\Presenter;
use LaravelEnso\LogManager\app\Classes\Collection;

class LogController extends Controller
{
    public function index()
    {
        return (new Collection())->get();
    }

    public function show(string $filename)
    {
        return (new Presenter($filename))->get();
    }

    public function download($filename)
    {
        $headers = ['Content-Type: application/log'];

        return response()->download(
            storage_path('logs/'.$filename), $filename, $headers
        );
    }

    public function destroy($filename)
    {
        $log = (new Destroyer($filename))->run();

        return [
            'log' => $log,
            'message' => __('The log was cleaned'),
        ];
    }
}
