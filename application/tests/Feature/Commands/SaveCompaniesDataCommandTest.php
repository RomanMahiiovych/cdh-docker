<?php

namespace Tests\Feature\Commands;

use App\Jobs\SaveCompaniesDataJob;
use App\Jobs\SavePositionsDataJob;
use App\Jobs\SaveUsersDataJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SaveCompaniesDataCommandTest extends TestCase
{

    public function test_command_can_dispatch_jobs_in_chain()
    {
        Bus::fake();

        $this->artisan('save:companies-data');

        Bus::assertDispatched(SaveCompaniesDataJob::class);
//        Bus::assertDispatched(SaveUsersDataJob::class);
//        Bus::assertDispatched(SavePositionsDataJob::class);

        Bus::assertChained([
            SaveCompaniesDataJob::class,
            SaveUsersDataJob::class,
            SavePositionsDataJob::class,
        ]);
    }

    public function test_command_displays_info_message_on_success()
    {
        $this->artisan('save:companies-data')
            ->expectsOutput('Database successfully updated!')
            ->assertExitCode(0);
    }

}
