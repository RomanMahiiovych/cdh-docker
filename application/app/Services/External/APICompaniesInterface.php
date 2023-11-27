<?php

namespace App\Services\External;

use Illuminate\Support\Collection;

interface APICompaniesInterface
{
    public function getUsers(): Collection;
    public function getCompanies(): Collection;
    public function getCompanyPositions(string $companyUuid): Collection;
}
