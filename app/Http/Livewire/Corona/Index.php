<?php

namespace App\Http\Livewire\Corona;

use App\Corona;
use App\Summary;
use Livewire\Component;

class Index extends Component
{
    public $countries;

    public $summary;

    public $search = '';

    public $field = 'deaths';

    public $order = 'desc';

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

        $this->countries = $this->fetchCountries();
        $this->summary = Summary::first();
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
        return Corona::query()
            ->orderBy($this->field, $this->order)
            ->when($this->search, function ($query) {
                return $query->where('country', 'like', '%'.$this->search.'%');
            })
            ->get();
    }

    public function updated()
    {
        $this->countries = $this->fetchCountries();
    }

    public function render()
    {
        return view('livewire.corona.corona');
    }
}
