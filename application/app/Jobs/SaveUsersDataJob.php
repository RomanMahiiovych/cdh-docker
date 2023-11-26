<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\External\AdminkoAPI\AdminkoApiClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class SaveUsersDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     * @throws \App\Exceptions\BaseApiException
     */
    public function handle(AdminkoApiClient $client): void
    {
        $page = 1;

        do {
            $users = $client->getUsers($page);

            $transformedUsersCollection = $this->transform($users);

            foreach ($transformedUsersCollection as $user)
            {
                if ($this->notExistsUserInDatabase($user['uuid'])) {
                    try {
                        User::create($user);
                    } catch (\Throwable) {
                        continue;
                    }
                }
            }

            $page++;
        } while ($users->isNotEmpty());

    }

    public function notExistsUserInDatabase(string $userId): bool
    {
        return User::where('uuid', $userId)->doesntExist();
    }

    public function transform(Collection $users)
    {
        return $users->map(function ($user) {
            return [
                'uuid' => $user['Id'],
                'first_name' => $user['FirstName'],
                'last_name' => $user['LastName'],
                'email' => $user['Email'],
                'password' => Hash::make($user['Email'])
            ];
        });
    }
}
