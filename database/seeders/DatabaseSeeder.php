<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('admins')->insert([
            'username' => 'root',
            'nama' => 'Kamera',
            'password' => 'root',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
