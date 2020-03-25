<?php

namespace App\Http\Livewire\Corona;

use App\Corona;
use App\Summary;
use Livewire\Component;

class Index extends Component
{
    public $countries = [];

    public $summary = [];

    public $search = '';

    public $field = 'deaths';

    public $direction = 'desc';

    protected $listeners = ['toggleDirection', 'refreshData' => '$refresh'];

    public function mount()
    {
        $this->countries = Corona::all();
        $this->summary = Summary::first();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->updated();
    }

    public function toggleDirection()
    {
        $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        $this->updated();
    }

    public function updated()
    {
        $query = Corona::orderBy($this->field, $this->direction);

        if ($this->search != '') {
            $query->where('country', 'like', '%'.strtolower($this->search).'%');
        }

        $this->countries = $query->get();
    }

    public function render()
    {
        return view('livewire.corona.corona');
    }
}
