<?php

namespace LaravelEnso\LogManager;

use Illuminate\Database\Eloquent\Model;

class LogReport extends Model
{
    public function getLaravelLogAttribute()
    {
        return self::where('name', 'laravel.log')->first();
    }
}
