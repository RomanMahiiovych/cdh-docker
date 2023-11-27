<?php

namespace App\Console\Commands;

use App\Jobs\SaveCompaniesDataJob;
use App\Jobs\SavePositionsDataJob;
use App\Jobs\SaveUsersDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class SaveCompaniesDataCommand extends Command
{
    public const SUCCESS_MESSAGE = 'Database successfully updated!';
    public const FAILURE_MESSAGE = 'Database has not successfully updated';

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

            $this->info(self::SUCCESS_MESSAGE);
        } catch (\Throwable $throwable) {
            Log::error(self::FAILURE_MESSAGE . ' : ' . $throwable->getMessage());
            $this->info(self::FAILURE_MESSAGE);
        }
    }
}
