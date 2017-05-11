<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->delete();
        User::create([
            'name'     => 'First name',
            'email'    => 'hagrid@yandex.ru',
            'password' => '111111',
        ]);
    }
}
