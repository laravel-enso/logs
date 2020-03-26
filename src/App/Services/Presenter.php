<?php

namespace LaravelEnso\Logs\App\Services;

use Illuminate\Support\Facades\File;
use LaravelEnso\Logs\App\Exceptions\Log;

class Presenter extends Handler
{
    private $filePath;

    public function __construct(string $filename)
    {
        $this->filePath = storage_path('logs'.DIRECTORY_SEPARATOR.$filename);
    }

    public function get(): array
    {
        $log = $this->log($this->filePath);

        $this->checkSize();

        $log['content'] = File::get($this->filePath);

        return $log;
    }

    private function checkSize(): void
    {
        $size = $this->formattedSize(
            File::size($this->filePath)
        );

        if ($size > self::LogSizeLimit) {
            throw Log::sizeExceded();
        }
    }
}
