<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'mirza',
            'username' => 'mirza',
            'email' => 'sugamirza@gmail.com',
            'password' => app('hash')->make('1'),
            'referral_id' => null,
            'api_token' => null,
        ]);
    }
}
