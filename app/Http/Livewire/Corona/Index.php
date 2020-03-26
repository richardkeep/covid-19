<?php

namespace App\Http\Livewire\Corona;

use App\Corona;
use App\Summary;
use Livewire\Component;
use App\Realtime\RealtimeCorona;
use App\Realtime\RealtimeSummary;

class Index extends Component
{
    public $countries = [];

    public $cases;

    public $deaths;

    public $todayDeaths;

    public $todayCases;

    public $recovered;

    public $critical;

    public $search = '';

    public $field = 'deaths';

    public $direction = 'desc';

    protected $listeners = [
        'toggleDirection',
        'refreshData' => '$refresh',
        'echo:corona,ApiUpdatedEvent' => 'apiUpdated',
    ];

    public function mount()
    {
        $this->countries = Corona::all();
        $summary = Summary::first();
        $this->setSummary($summary);
    }

    protected function setSummary($summary)
    {
        $this->cases = $summary->cases;
        $this->deaths = $summary->deaths;
        $this->todayDeaths = $summary->todayDeaths;
        $this->todayCases = $summary->todayCases;
        $this->recovered = $summary->recovered;
        $this->critical = $summary->critical;
    }

    public function apiUpdated($data)
    {
        $this->countries = RealtimeCorona::all();
        $summary = RealtimeSummary::first();
        $this->setSummary($summary);
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
