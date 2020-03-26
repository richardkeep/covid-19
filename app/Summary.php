<?php

namespace App;

use Sushi\Sushi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use Sushi;

    public function getRows()
    {
        return Cache::remember('covid-19-summary', Carbon::parse('1 minute'), function () {
            return [Http::get('https://corona.richardkeep.dev/all')->json()];
        });
    }
}
