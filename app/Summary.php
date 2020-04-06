<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    public static function api()
    {
        return Cache::remember('covid-19-summary', Carbon::parse('1 minute'), function () {
            return Http::get('https://corona.richardkeep.dev/all')->json();
        });
    }
}
