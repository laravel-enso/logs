<?php

namespace LaravelEnso\LogManager\app\Http\Services;

use Jenssegers\Date\Date;

class LogService
{
    private const LogSizeLimit = 0.5;

    public function index()
    {
        $logs = $this->getLogs();
        $actionButtons = $this->getActionButtons();

        return view('laravel-enso/logmanager::index', compact('logs', 'actionButtons'));
    }

    public function show($fileName)
    {
        $file = storage_path('logs/'.$fileName);
        $log = json_encode($this->getLogEntry($file));
        $size = $this->getFormattedSize(\File::size($file));
        if ($size > self::LogSizeLimit) {
            flash()->warning(__('Log file exceeds limit of').': '.self::LogSizeLimit.' MB');

            return back();
        }

        $content = \File::get($file);
        $actionButtons = $this->getActionButtons();

        return view('laravel-enso/logmanager::show', compact('log', 'content', 'actionButtons'));
    }

    public function download($fileName)
    {
        $headers = ['Content-Type: application/log'];

        return response()->download(storage_path('logs/'.$fileName, $fileName, $headers));
    }

    public function empty($log)
    {
        $file = storage_path('logs/'.$log);
        \File::put($file, '');
        $log = $this->getLogEntry($file);

        return $log;
    }

    private function getLogs()
    {
        $logs = collect();
        $files = \File::files(storage_path('logs'));

        foreach ($files as $file) {
            if (substr($file, -4) !== '.log') {
                continue;
            }

            $logs->push($this->getLogEntry($file));
        }

        return $logs;
    }

    private function getActionButtons()
    {
        return collect([
            'show'     => request()->user()->can('access-route', 'system.logs.show') ?: false,
            'edit'     => request()->user()->can('access-route', 'system.logs.edit') ?: false,
            'download' => request()->user()->can('access-route', 'system.logs.download') ?: false,
            'delete'   => request()->user()->can('access-route', 'system.logs.destroy') ?: false,
        ]);
    }

    private function getLogEntry($file)
    {
        $lastModified = \File::lastModified($file);
        $size = $this->getFormattedSize(\File::size($file));
        Date::setLocale(request()->user()->language);

        return [
            'path'         => $file,
            'name'         => last(explode('/', $file)),
            'size'         => $size,
            'canBeSeen'    => $size <= self::LogSizeLimit,
            'lastModified' => Date::createFromTimestamp($lastModified)->toDayDateTimeString(),
        ];
    }

    private function getFormattedSize($size)
    {
        return round($size / 1048576, 2);
    }
}
