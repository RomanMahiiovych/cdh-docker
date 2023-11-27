<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\API\Response\GetAllCompanies200;
use Tests\TestCase;

class ApiCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_test_get_companies_200(): void
    {
        $this->artisan('save:companies-data');

        $this->getJson(route('api.companies.list'))
            ->assertOk()
            ->assertJson(GetAllCompanies200::getTypesDefinition())
            ->assertJsonStructure(GetAllCompanies200::getStructureDefinition());
    }
}
