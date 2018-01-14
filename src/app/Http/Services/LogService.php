<?php

namespace LaravelEnso\LogManager\app\Http\Services;

use Carbon\Carbon;
use LaravelEnso\LogManager\app\Exceptions\LogException;

class LogService
{
    private const LogSizeLimit = 0.5;

    public function index()
    {
        return ['logs' => $this->getLogs()];
    }

    public function show($fileName)
    {
        $file = storage_path('logs/'.$fileName);
        $log = $this->getLog($file);
        $size = $this->getFormattedSize(\File::size($file));

        if ($size > self::LogSizeLimit) {
            throw new LogException(__(
                'Log file exceeds the limit of :limit MB',
                ['limit' => self::LogSizeLimit]
            ));
        }

        $content = \File::get($file);

        return compact('log', 'content');
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
        $log = $this->getLog($file);

        return ['log' => $log, 'message' => __('The log was cleaned')];
    }

    private function getLogs()
    {
        $logs = collect();
        $files = \File::files(storage_path('logs'));

        foreach ($files as $file) {
            if (substr($file, -4) === '.log') {
                $logs->push($this->getLog($file));
            }
        }

        return $logs;
    }

    private function getLog($file)
    {
        $modified = \File::lastModified($file);
        $size = $this->getFormattedSize(\File::size($file));

        return [
            'path' => $file,
            'name' => last(explode('/', $file)),
            'size' => $size,
            'canBeSeen' => $size <= self::LogSizeLimit,
            'modified' => Carbon::createFromTimestamp($modified),
        ];
    }

    private function getFormattedSize($size)
    {
        return round($size / 1048576, 3);
    }
}
