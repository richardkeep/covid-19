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

    protected $listeners = [
        'toggleOrder',
        'echo:corona,ApiUpdatedEvent' => '$refresh',
    ];

    protected $updatesQueryString = [
        'search',
        'field',
        'order',
        'lang',
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'field', 'order', 'lang'));

        $this->summary = Summary::api();
    }

    public function clearSearch()
    {
        $this->search = '';
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

        return collect(Corona::api())
        ->when($this->search, function ($collection) {
            return $collection->filter(function ($obj) {
                return Str::of(strtolower($obj['country']))->contains(strtolower($this->search));
            });
        })
        ->sort($sorter)
        ->all();
    }

    public function render()
    {
        config(['app.locale' => $this->lang]);

        return view('livewire.corona.corona', [
            'countries' => $this->fetchCountries(),
        ]);
    }
}
