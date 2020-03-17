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

    public function mount()
    {
        $this->countries = Corona::all();
        $this->summary = Summary::first();
    }

    public function updatedSearch()
    {
        if ($this->search == '') {
            $this->countries = Corona::all();

            return false;
        }

        $this->countries = Corona::where('country', 'like', '%'.strtolower($this->search).'%')->get();
    }

    public function render()
    {
        return view('livewire.corona.corona');
    }
}
