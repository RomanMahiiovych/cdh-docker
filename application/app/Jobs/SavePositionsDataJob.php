<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\Position;
use App\Services\External\APICompaniesInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SavePositionsDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     * @throws \App\Exceptions\BaseApiException
     */
    public function handle(APICompaniesInterface $client): void
    {
        $companies = Company::all();
        foreach ($companies as $company)
        {
            $positions = $client->getCompanyPositions($company->getKey());

            $transformedPositionsCollection = $this->transform($positions);

            foreach ($transformedPositionsCollection as $position)
            {
                if ($this->notExistsPositionInDatabase($position)) {
                    try {
                        Position::create($position);
                    } catch (\Throwable $throwable) {
                        Log::error('SavePositionsDataJob failed: ' . $throwable->getMessage());
                        continue;
                    }
                }
            }
        }
    }

    public function notExistsPositionInDatabase(array $position): bool
    {
        return Position::where('company_id', $position['company_id'])
            ->where('user_id', $position['user_id'])
            ->doesntExist();
    }

    public function transform(Collection $users)
    {
        return $users->map(function ($user) {
            return [
                'uuid' => Str::uuid(),
                'company_id' => $user['CompanyId'],
                'user_id' => $user['UserId'],
                'name' => $user['Position'],
            ];
        });
    }
}
