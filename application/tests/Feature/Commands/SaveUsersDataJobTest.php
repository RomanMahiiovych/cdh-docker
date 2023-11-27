<?php

namespace Tests\Feature\Commands;

use App\Jobs\SaveUsersDataJob;
use App\Services\External\APICompaniesInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveUsersDataJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_users_to_the_database()
    {
        $client = app(APICompaniesInterface::class);
        $users = $client->getUsers(page: 2);

        SaveUsersDataJob::dispatchSync($client);

        foreach ($users as $user) {
            $this->assertDatabaseHas('users', [
                'uuid'       => $user['Id'],
                'first_name' => $user['FirstName'],
                'last_name'  => $user['LastName'],
                'email'      => $user['Email'],
            ]);
        }
    }

}
