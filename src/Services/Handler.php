<?php

namespace LaravelEnso\Logs\App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\App\Services\Decimals;

abstract class Handler
{
    public const LogSizeLimit = 0.5;

    protected function log($file): array
    {
        $size = $this->formattedSize(File::size($file));

        return [
            'name' => (new Collection(explode(DIRECTORY_SEPARATOR, $file)))->last(),
            'size' => $size,
            'visible' => $size <= self::LogSizeLimit,
            'modified' => Carbon::createFromTimestamp(File::lastModified($file)),
        ];
    }

    protected function formattedSize($size): float
    {
        return Decimals::div($size, 1024 * 1024, 3);
    }
}
