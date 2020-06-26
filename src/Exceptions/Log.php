<?php

namespace LaravelEnso\Logs\Exceptions;

use LaravelEnso\Helpers\Exceptions\EnsoException;
use LaravelEnso\Logs\Services\Presenter;

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
