<?php

namespace LaravelEnso\Logs\app\Services;

use Illuminate\Support\Facades\File;
use LaravelEnso\Logs\app\Exceptions\Log as Exception;

class Presenter extends Handler
{
    private $file;

    public function __construct(string $filename)
    {
        $this->file = storage_path('logs/'.$filename);
    }

    public function get()
    {
        $log = $this->log($this->file);

        $this->checkSize();

        $log['content'] = File::get($this->file);

        return $log;
    }

    private function checkSize()
    {
        $size = $this->formattedSize(
            File::size($this->file)
        );

        if ($size > self::LogSizeLimit) {
            throw Exception::size(self::LogSizeLimit);
        }
    }
}
