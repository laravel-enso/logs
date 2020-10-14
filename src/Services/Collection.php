<?php

namespace LaravelEnso\Logs\Services;

use Illuminate\Support\Collection as Collect;
use Illuminate\Support\Facades\File;

class Collection extends Handler
{
    private $files;

    public function __construct()
    {
        $this->files = File::files(storage_path('logs'));
    }

    public function get(): Collect
    {
        return (new Collect($this->files))
            ->filter(fn ($file) => $file->getExtension() === 'log')
            ->map(fn ($file) => $this->log($file))
            ->values();
    }
}
