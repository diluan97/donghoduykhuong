<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'admin12@gmail.com',
            'password'=>bcrypt('12345678'),
            'remember_token'=>md5(Carbon::now() . rand(1000,9999)),
            'role'=> 1,
        ]);
    }
}
