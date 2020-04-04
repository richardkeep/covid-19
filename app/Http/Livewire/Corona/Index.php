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

    private $sorting = 'sortByDesc';

    protected $listeners = [
        'toggleOrder',
        'echo:corona,ApiUpdatedEvent' => '$refresh',
    ];

    protected $updatesQueryString = [
        'search',
        'field',
        'order',
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'field', 'order'));
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->updated();
    }

    public function toggleOrder()
    {
        if ($this->order == 'desc') {
            $this->order = 'asc';
            $this->sorting = 'sortBy';
        } else {
            $this->order = 'desc';
            $this->sorting = 'sortByDesc';
        }

        $this->updated();
    }

    protected function fetchCountries()
    {
        return collect(Corona::api())
        ->{$this->sorting}($this->field)
        ->when($this->search, function ($collection) {
            return $collection->filter(function ($obj) {
                return Str::of(strtolower($obj['country']))->contains(strtolower($this->search));
            });
        })->all();
    }

    public function updated()
    {
        $this->countries = $this->fetchCountries();
    }

    public function render()
    {
        return view('livewire.corona.corona', [
            'summary' => Summary::api(),
            'countries' => $this->fetchCountries(),
        ]);
    }
}
