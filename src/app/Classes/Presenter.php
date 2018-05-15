<?php

namespace LaravelEnso\LogManager\app\Classes;

use LaravelEnso\LogManager\app\Exceptions\LogException;

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

        $this->verifySize();

        $log['content'] = \File::get($this->file);

        return $log;
    }

    private function verifySize()
    {
        $size = $this->formattedSize(
            \File::size($this->file)
        );

        if ($size > self::LogSizeLimit) {
            throw new LogException(__(
                'Log file exceeds the limit of :limit MB',
                ['limit' => self::LogSizeLimit]
            ));
        }
    }
}
