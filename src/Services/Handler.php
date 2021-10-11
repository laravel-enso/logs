<?php

namespace LaravelEnso\Logs\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\Services\Decimals;

abstract class Handler
{
    public const LogSizeLimit = 0.5;

    protected function log($file): array
    {
        $size = $this->formattedSize(File::size($file));
        $name = File::name($file);
        $extension = File::extension($file);

        return [
            'name' => "{$name}.{$extension}",
            'size' => $size,
            'visible' => $size <= self::LogSizeLimit && $extension === 'log',
            'modified' => Carbon::createFromTimestamp(File::lastModified($file)),
        ];
    }

    protected function formattedSize($size): float
    {
        return Decimals::div($size, 1024 * 1024, 3);
    }
}
