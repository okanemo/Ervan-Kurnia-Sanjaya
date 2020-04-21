<?php

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
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@okanemo.com',
            'password' => Hash::make('okanemo'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@okanemo.com',
            'password' => Hash::make('okanemo'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'Member',
            'email' => 'member@okanemo.com',
            'password' => Hash::make('okanemo'),
            'role_id' => 3
        ]);
    }
}
