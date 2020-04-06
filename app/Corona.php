<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Corona extends Model
{
    public static function api()
    {
        return Cache::remember('covid19-countries', Carbon::parse('1 minute'), function () {
            return collect(Http::get('https://corona.richardkeep.dev/countries')->json());
        });
    }
}
