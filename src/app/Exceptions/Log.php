<?php

namespace LaravelEnso\Logs\app\Exceptions;

use LaravelEnso\Helpers\app\Exceptions\EnsoException;

class Log extends EnsoException
{
    public static function overLimit($limit)
    {
        return new self(__('Log file exceeds the limit of :limit MB', ['limit' => $limit]));
    }
}
