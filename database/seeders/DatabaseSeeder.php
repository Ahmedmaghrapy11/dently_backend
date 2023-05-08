<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Dentis;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create([
            'name' => 'john doe',
            'email' => 'john@gmail.com',
            'role' => 'dentist'
        ]);

        Clinic::factory()->create([
            'user_id' => $user->id
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
