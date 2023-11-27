<?php

namespace Tests\Feature\Commands;

use App\Jobs\SaveCompaniesDataJob;
use App\Services\External\APICompaniesInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveCompaniesDataJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_companies_to_the_database()
    {
        $client = app(APICompaniesInterface::class);
        $companies = $client->getCompanies(page: 2);

        SaveCompaniesDataJob::dispatchSync($client);

        foreach ($companies as $company) {
            $this->assertDatabaseHas('companies', [
                'uuid' => $company['Id'],
                'name' => $company['Name'],
                'address' => $company['Address'],
            ]);
        }
    }

}
