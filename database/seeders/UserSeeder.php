<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->truncate();
        User::factory()->predefinedUser('Clarence Rhey Salaveria', 'cbsalaveria@ncmh.gov.ph', 'july271914', 'eluxify')
            ->create();
        User::factory()->predefinedUser('Zach Rancio', 'zach@gmail.com', 'Password@123', 'zachy')->create();
        User::factory()->predefinedUser('Jon Arvy Enriquez', 'arvy@gmail.com', 'Axelium0329', 'arvy')->create();
        User::factory()->predefinedUser('Maxine', 'max@gmail.com', '12345678', 'max')->create();
        User::factory()->predefinedUser('Irhene', 'irhene@gmail.com', '87654321', 'irhene')->create();
    }
}
