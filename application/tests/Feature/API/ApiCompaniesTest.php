<?php

namespace Tests\Feature\API;

use Tests\Feature\API\Response\GetAllCompanies200;
use Tests\TestCase;

class ApiCompaniesTest extends TestCase
{
    /**
     * @test
     */
    public function it_test_get_companies_200(): void
    {
        $this->getJson(route('api.companies.list'))
            ->assertOk()
            ->assertJson(GetAllCompanies200::getTypesDefinition())
            ->assertJsonStructure(GetAllCompanies200::getStructureDefinition());
    }
}
