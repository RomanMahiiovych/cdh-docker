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
    public function getUsers($page = 1): Collection
    {
        try {
            $users = $this->send('users', ['page' => $page]);
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $users->collect('users');
    }

    /**
     * @return Collection
     * @throws BaseApiException
     */
    public function getCompanies($page = 1): Collection
    {
        try {
            $companies = $this->send('companies', ['page' => $page]);
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $companies->collect('compaines');
    }

    /**
     * @param string $companyUuid
     * @return Collection
     * @throws BaseApiException
     */
    public function getCompanyPositions(string $companyUuid): Collection
    {
        try {
            $positions = $this->send("company/{$companyUuid}", []);
        } catch (RequestException $exception) {
            throw new BaseApiException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $positions->collect('positions');
    }
}
