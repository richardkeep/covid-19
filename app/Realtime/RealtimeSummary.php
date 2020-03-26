<?php

namespace App\Realtime;

use Sushi\Sushi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class RealtimeSummary extends Model
{
    use Sushi;

    public function getRows()
    {
        $data = [Http::get('https://corona.richardkeep.dev/realtime/all')->json()];

        Cache::remember('covid-19-summary', Carbon::parse('1 minute'), function () use ($data) {
            return $data;
        });

        return $data;
    }
}
