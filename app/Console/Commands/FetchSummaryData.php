<?php

namespace App\Console\Commands;

use App\Events\ApiUpdatedEvent;
use Illuminate\Console\Command;

class FetchSummaryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corona:api-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Corona Data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new ApiUpdatedEvent([]));
    }
}
