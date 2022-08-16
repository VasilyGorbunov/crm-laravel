<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'phone' => '1111',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'status' => '1',
        ]);
    }
}
