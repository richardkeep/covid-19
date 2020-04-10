<?php

namespace App\Http\Livewire\Corona;

use App\Corona;
use App\Summary;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $search = '';

    public $field = 'deaths';

    public $order = 'desc';

    public $lang = 'en';

    public $summary;

    protected static $fields = [
        'cases', 'todayCases', 'deaths',
        'todayDeaths', 'recovered', 'critical',
    ];

    protected $updatesQueryString = ['search', 'field', 'order', 'lang'];

    public function mount()
    {
        $this->fill(request()->only('search', 'field', 'order', 'lang'));
        $this->summary = Summary::api();
    }

    protected function fetchCountries()
    {
        if (! in_array($this->field, static::$fields)) {
            return [];
        }

        $sorter = app()->make('collection.multiSort', [
            $this->field => $this->order,
            'cases' => $this->order,
            'recovered' => $this->order,
        ]);

        return Corona::api()->when($this->search, function ($collection) {
            return $collection->filter(function ($row) {
                return Str::of(strtolower($row['country']))->contains(strtolower($this->search));
            });
        })->sort($sorter)->all();
    }

    public function render()
    {
        config(['app.locale' => $this->lang]);

        return view('livewire.corona.corona', [
            'countries' => $this->fetchCountries(),
        ]);
    }
}
