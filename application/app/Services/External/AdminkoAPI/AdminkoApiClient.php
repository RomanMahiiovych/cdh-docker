<?php

namespace App\Services\External\AdminkoAPI;

use App\Exceptions\BaseApiException;
use App\Services\External\APICompaniesInterface;
use App\Services\External\RequestHelper;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

class AdminkoApiClient extends RequestHelper implements APICompaniesInterface
{
    /**
     * @return Collection
     * @throws BaseApiException
     */
    public function getUsers(): Collection
    {
        try {
            $users = $this->send('users');
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $users->collect();
    }

    /**
     * @return Collection
     * @throws BaseApiException
     */
    public function getCompanies(): Collection
    {
        try {
            $companies = $this->send('companies');
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $companies->collect();
    }

    /**
     * @param string $companyUuid
     * @return Collection
     * @throws BaseApiException
     */
    public function getCompanyPositions(string $companyUuid): Collection
    {
        try {
            $positions = $this->send("company/{$companyUuid}");
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $positions->collect();
    }
}
