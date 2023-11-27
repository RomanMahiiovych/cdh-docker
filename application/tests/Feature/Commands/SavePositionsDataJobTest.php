<?php

namespace Tests\Feature\Commands;

use App\Jobs\SaveCompaniesDataJob;
use App\Jobs\SavePositionsDataJob;
use App\Jobs\SaveUsersDataJob;
use App\Models\Company;
use App\Services\External\APICompaniesInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavePositionsDataJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_positions_to_the_database()
    {
        $client = app(APICompaniesInterface::class);

        SaveCompaniesDataJob::dispatchSync($client);
        SaveUsersDataJob::dispatchSync($client);

        $company = Company::inRandomOrder()->first();
        $positions = $client->getCompanyPositions(companyUuid: $company->getKey());

        SavePositionsDataJob::dispatchSync($client);

        foreach ($positions as $position) {
            $this->assertDatabaseHas('positions', [
                'name'       => $position['Position'],
                'company_id' => $position['CompanyId'],
                'user_id'    => $position['UserId'],
            ]);
        }
    }


}
