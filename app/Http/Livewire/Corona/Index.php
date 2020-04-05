<?php

namespace App\Http\Livewire\Corona;

use App\Corona;
use App\Summary;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $search = '';

    public $field = 'deaths';

    public $order = 'desc';

    public $lang = 'en';

    public $summary;

    public $countries;

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

        Session::put('lang', $this->lang);

        $this->summary = Summary::api();
        $this->countries = $this->fetchCountries();
    }

    public function updatedLang()
    {
        Session::put('lang', $this->lang);
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->updated();
    }

    public function toggleOrder()
    {
        $this->order = $this->order == 'desc' ? 'asc' : 'desc';

        $this->updated();
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

    public function updated()
    {
        $this->countries = $this->fetchCountries();
    }

    public function render()
    {
        Config(['app.locale' => Session::get('lang')]);

        return view('livewire.corona.corona');
    }
}
