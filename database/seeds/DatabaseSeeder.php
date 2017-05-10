<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
        // php artisan db:seed --class=DatabaseSeeder

        /**
         * Clean tables
         */
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('news')->delete();

        /**
         * Create roles
         */
        $rolesCollect = collect(['admin', 'user', 'moderator']);
        $rolesCollect->each(function($role) {
            DB::table('roles')->insert([
                'slug' => $role
            ]);
        });

        /**
         * Get all roles
         */
        $roles = App\Models\Role::all();

        /**
         * Create admin with my password
         */
        App\Models\User::create([
                    'name' => 'admin',
                    'email' => 'admin@admin.ru',
                    'password' => bcrypt('1234'),
                    'remember_token' => str_random(10),
        ])->roles()->sync([$roles[0]->id]);
        
        factory(User::class, 1)->create([
            'email' => 'admin@admin.ru',
        ])->first()->roles()->sync([$roles[0]->id]);
        
        /**
         * Create moderator with my password
         */
        App\Models\User::create([
                    'name' => 'mod',
                    'email' => 'mod@mod.ru',
                    'password' => bcrypt('1234'),
                    'remember_token' => str_random(10),
        ])->roles()->sync([$roles[1]->id, $roles[0]->id]);
        
        // 1 2 3 4 5
        // sync([2,3])
        // 2 3
        // sync([1,4,5], false)
        // 1 4 5 2 3
        
        /**
         * Creating users with different roles.
         */
        factory('App\Models\User')->create()
                ->roles()->sync($roles->pluck('id')->random(3)->toArray());
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[0]->id, $roles[1]->id]);
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[0]->id, $roles[2]->id]);
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[1]->id, $roles[2]->id]);
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[0]->id]);
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[1]->id]);
        factory('App\Models\User')->create()
                ->roles()->sync([$roles[2]->id]);

        /**
         * Create 100 news.
         */
        factory(App\Models\News::class, 100)->create();
    }

}
