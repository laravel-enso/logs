<?php

namespace LaravelEnso\Logs\App\Exceptions;

use LaravelEnso\Helpers\App\Exceptions\EnsoException;
use LaravelEnso\Logs\App\Services\Presenter;

class Log extends EnsoException
{
    public static function sizeExceded()
    {
        return new self(__(
            'Log file exceeds the limit of :limit MB',
            ['limit' => Presenter::LogSizeLimit]
        ));
    }
}
