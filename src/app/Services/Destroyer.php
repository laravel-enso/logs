<?php

namespace LaravelEnso\Logs\app\Services;

use Illuminate\Support\Facades\File;

class Destroyer extends Handler
{
    private $file;

    public function __construct(string $filename)
    {
        $this->file = storage_path('logs/'.$filename);
    }

    public function handle()
    {
        File::put($this->file, '');

        return $this->log($this->file);
    }
}
