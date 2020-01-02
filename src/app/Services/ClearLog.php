<?php

namespace LaravelEnso\Logs\App\Services;

use Illuminate\Support\Facades\File;

class ClearLog extends Handler
{
    private string $filePath;

    public function __construct(string $filename)
    {
        $this->filePath = storage_path('logs'.DIRECTORY_SEPARATOR.$filename);
    }

    public function handle(): array
    {
        File::put($this->filePath, '');

        return $this->log($this->filePath);
    }
}
