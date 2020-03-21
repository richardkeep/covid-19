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

    public function mount()
    {
        $this->countries = Corona::all();
        $this->summary = Summary::first();
    }

    public function updated($name)
    {
        $query = Corona::query();

        if (in_array($name, ['field', 'direction'])) {
            $query->orderBy($this->field, $this->direction);
        }

        if ($name == 'search' || $this->search != '') {
            $query->where('country', 'like', '%'.strtolower($this->search).'%');
        }

        $this->countries = $query->get();
    }

    public function render()
    {
        return view('livewire.corona.corona');
    }
}
