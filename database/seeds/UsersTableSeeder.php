<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('Users')->delete();
        User::create([
            'name' => 'First name',
            'email' => 'hagrid@yandex.ru',
            'password' => '111111',
        ]);
    }

}
