<?php

namespace LaravelEnso\Logs\app\Services;

use Illuminate\Support\Facades\File;

class Collection extends Handler
{
    private $files;

    public function __construct()
    {
        $this->files = File::files(storage_path('logs'));
    }

    public function get()
    {
        return collect($this->files)
            ->filter(function ($file) {
                return $file->getExtension() === 'log';
            })->map(function ($file) {
                return $this->log($file);
            });
    }
}
