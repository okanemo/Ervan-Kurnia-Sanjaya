<?php

use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Super Admins
        DB::table('accesses')->insert([
            'role_id' => 1,
            'access' => 'Profile'
        ]);

        DB::table('accesses')->insert([
            'role_id' => 1,
            'access' => 'User'
        ]);

        // Admins
        DB::table('accesses')->insert([
            'role_id' => 2,
            'access' => 'Profile'
        ]);

        DB::table('accesses')->insert([
            'role_id' => 2,
            'access' => 'User'
        ]);

        // Members
        DB::table('accesses')->insert([
            'role_id' => 3,
            'access' => 'Profile'
        ]);
    }
}
