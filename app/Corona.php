<?php

namespace App;

use Sushi\Sushi;
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
        'Congo' => 'Congo - Kinshasa',
        'Saint Martin' => 'St. Martin',
        'Saint Lucia' => 'St. Lucia',
        'Trinidad and Tobago' => 'Trinidad & Tobago',
        'Antigua and Barbuda' => 'Antigua & Barbuda',
        'Ivory Coast' => 'Côte d’Ivoire',
        'St. Vincent Grenadines' => 'St. Vincent & Grenadines',
        'Faeroe Islands' => 'Faroe Islands',
        'Turks and Caicos' => 'Turks & Caicos Islands',
        'Myanmar' => 'Myanmar (Burma)',
        'Cabo Verde' => 'Cape Verde',
        'CAR' => 'Central African Republic',
    ];

    public function getRows()
    {
        return Cache::remember('covid19', Carbon::parse('20 minutes'), function () {
            return Http::get('https://corona.richardkeep.dev/countries')->json();
        });
    }

    public function getEmojiAttribute()
    {
        $country = array_key_exists($this->country, $this->mappings) ? $this->mappings[$this->country] : $this->country;

        return collect(
            json_decode(file_get_contents(public_path('flags.json')), true)
        )->firstWhere('name', $country)['emoji'];
    }
}
