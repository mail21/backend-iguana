<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
