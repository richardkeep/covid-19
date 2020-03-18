<?php

namespace App;

use Sushi\Sushi;
use Goutte\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Corona extends Model
{
    use Sushi;

    protected $mappings = [
        'UK' => 'United Kingdom',
        'S. Korea' => 'South Korea',
        'N. Korea' => 'North Korea',
        'USA' => 'United States',
        'Hong Kong' => 'Hong Kong SAR China',
        'UAE' => 'United Arab Emirates',
        'Palestine' => 'Palestinian Territories',
        'Bosnia and Herzegovina' => 'Bosnia & Herzegovina',
        'North Macedonia' => 'Macedonia',
        'Macao' => 'Macau SAR China',
        'DRC' => 'Congo - Kinshasa',
        'Saint Martin' => 'St. Martin',
        'Saint Lucia' => 'St. Lucia',
        'St. Barth' => 'St. Barthélemy',
        'Trinidad and Tobago' => 'Trinidad & Tobago',
        'Antigua and Barbuda' => 'Antigua & Barbuda',
        'Ivory Coast' => 'Côte d’Ivoire',
        'St. Vincent Grenadines' => 'St. Vincent & Grenadines',
        'Faeroe Islands' => 'Faroe Islands',
    ];

    protected $casts = [
        'todayCases' => 'integer',
        'todayDeaths' => 'integer',
        'cases' => 'integer',
        'deaths'    => 'integer',
        'recovered' => 'integer',
        'activeCases'   => 'integer',
        'critical' => 'integer',
    ];

    public function getRows()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.worldometers.info/coronavirus/');

        $keys = ['country', 'cases', 'todayCases', 'deaths', 'todayDeaths', 'recovered', 'activeCases', 'critical'];

        return collect($crawler->filter('#main_table_countries_today')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $j) {
                return trim($td->text());
            });
        }))->filter(function ($item, $key) {
            return $key > 0;
        })->map(function ($item, $k) use ($keys) {
            foreach ($keys as $kk => $v) {
                if ($k > 0) {
                    $d[$v] = str_replace(',', '', $item[$kk]);
                } else {
                    $d[$v] = $item[$kk];
                }
            }

            return $d;
        })->values()->all();

        // return Cache::remember('corona', Carbon::parse('10 minutes'), function () {
        //     return Http::get('https://corona.lmao.ninja/countries')->json();
        // });
    }

    public function emoji()
    {
        $country = array_key_exists($this->country, $this->mappings) ? $this->mappings[$this->country] : $this->country;

        return collect(json_decode(file_get_contents(public_path('flags.json')), true))->firstWhere('name', $country)['emoji'];
    }
}
