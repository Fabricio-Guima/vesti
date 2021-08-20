<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        DB::table('users')->insert([
            'name' => 'fabricio',
            'cnpj' => '15151515',
            'email' => 'fsgkof'.'@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => now()
        ]);
    }
}
