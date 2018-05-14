<?php

namespace LaravelEnso\LogManager\app\Classes;

class Destroyer extends Handler
{
    private $file;

    public function __construct(string $filename)
    {
        $this->file = storage_path('logs/'.$filename);
    }

    public function run()
    {
        \File::put($this->file, '');

        return $this->log($this->file);
    }
}
