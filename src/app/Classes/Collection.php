<?php

namespace LaravelEnso\LogManager\app\Classes;

class Collection extends Handler
{
    private $files;

    public function __construct()
    {
        $this->files = \File::files(storage_path('logs'));
    }

    public function get()
    {
        return collect($this->files)
            ->filter(function ($file) {
                return substr($file, -4) === '.log';
            })->map(function ($file) {
                return $this->log($file);
            });
    }
}
