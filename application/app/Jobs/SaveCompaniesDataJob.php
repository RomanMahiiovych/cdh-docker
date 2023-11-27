<?php

namespace App\Jobs;

use App\Models\Company;
use App\Services\External\APICompaniesInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class SaveCompaniesDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     * @throws \App\Exceptions\BaseApiException
     */
    public function handle(APICompaniesInterface $client): void
    {
        $page = 1;

        do {
            $companies = $client->getCompanies($page);

            $transformedCompaniesCollection = $this->transform($companies);

            foreach ($transformedCompaniesCollection as $company)
            {
                if ($this->notExistsCompanyInDatabase($company['uuid'])) {
                    try {
                        Company::create($company);
                    } catch (\Throwable $throwable) {
                        Log::error('SaveCompaniesDataJob failed: ' . $throwable->getMessage());
                        continue;
                    }
                }
            }

            $page++;
        } while ($companies->isNotEmpty());

    }

    public function notExistsCompanyInDatabase(string $companyId): bool
    {
        return Company::where('uuid', $companyId)->doesntExist();
    }

    public function transform(Collection $companies): Collection
    {
        return $companies->map(function ($company) {
            return [
                'uuid' => $company['Id'],
                'name' => $company['Name'],
                'address' => $company['Address'],
            ];
        });
    }
}
