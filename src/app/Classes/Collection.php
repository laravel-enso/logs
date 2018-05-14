<?php

namespace LaravelEnso\LogManager\app\Classes;

use Illuminate\Contracts\Support\Responsable;

class Collection extends Handler implements Responsable
{
    private $files;

    public function __construct()
    {
        $this->files = \File::files(storage_path('logs'));
    }

    public function toResponse($request)
    {
        return collect($this->files)
            ->filter(function ($file) {
                return substr($file, -4) === '.log';
            })->map(function ($file) {
                return $this->log($file);
            });
    }
}
