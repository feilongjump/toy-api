<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(50)->create();

        $user = User::first();
        $user->name = 'super';
        $user->email = 'super@example.com';
        $user->is_admin = true;
        $user->save();
    }
}
