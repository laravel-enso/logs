<?php

namespace LaravelEnso\LogManager\app\Models;

use Illuminate\Database\Eloquent\Model;

class LogReport extends Model
{
    public function getLaravelLogAttribute()
    {
        return self::where('name', 'laravel.log')->first();
    }
}
