<?php

namespace App\Console\Commands;

use App\Jobs\SaveCompaniesDataJob;
use App\Jobs\SavePositionsDataJob;
use App\Jobs\SaveUsersDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class SaveCompaniesDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:companies-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save companies data from AdminkoApiClient to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Bus::chain([
                new SaveCompaniesDataJob,
                new SaveUsersDataJob,
                new SavePositionsDataJob,
            ])->dispatch();
        } catch (\Throwable) {
            $this->info('Database has not successfully updated!');
        }

        $this->info('Database successfully updated!');
    }
}
