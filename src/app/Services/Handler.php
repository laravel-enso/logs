<?php

namespace LaravelEnso\Logs\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

abstract class Handler
{
    protected const LogSizeLimit = 0.5;

    protected function log($file)
    {
        $size = $this->formattedSize(\File::size($file));

        return [
            'name' => collect(explode(DIRECTORY_SEPARATOR, $file))->last(),
            'size' => $size,
            'visible' => $size <= self::LogSizeLimit,
            'modified' => Carbon::createFromTimestamp(
                File::lastModified($file)
            ),
        ];
    }

    protected function formattedSize($size)
    {
        return round($size / 1048576, 3);
    }
}
