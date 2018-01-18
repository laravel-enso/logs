<?php

namespace LaravelEnso\LogManager\app\Handlers;

use Carbon\Carbon;

abstract class Handler
{
    protected const LogSizeLimit = 0.5;

    protected function log($file)
    {
        $size = $this->formattedSize(\File::size($file));

        return [
            'path' => $file,
            'name' => collect(explode('/', $file))->last(),
            'size' => $size,
            'canBeSeen' => $size <= self::LogSizeLimit,
            'modified' => Carbon::createFromTimestamp(
                \File::lastModified($file)
            ),
        ];
    }

    protected function formattedSize($size)
    {
        return round($size / 1048576, 3);
    }
}
