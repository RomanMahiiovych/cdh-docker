<?php

namespace App\Services\External\AdminkoAPI;

use App\Services\External\APICompaniesInterface;
use App\Services\External\RequestHelper;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class AdminkoApiClient extends RequestHelper implements APICompaniesInterface
{
    public function getUsers(): Collection
    {
        $users = collect();
        try {
            $users = $this->send('users');
        } catch (RequestException $exception) {

        }

        return $users->collect();
    }

    public function getCompanies(): Collection
    {
        $companies = collect();
        try {
            $companies = $this->send('companies');
        } catch (RequestException $exception) {

        }

        return $companies->collect();
    }

    public function getCompanyPositions(string $companyUuid): Collection
    {
        $positions = collect();
        try {
            $positions = $this->send("company/{$companyUuid}");
        } catch (RequestException $exception) {

        }

        return $positions->collect();
    }
}
