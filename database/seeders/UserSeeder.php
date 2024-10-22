<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->predefinedUser('Clarence Rhey Salaveria', 'cbsalaveria@ncmh.gov.ph', 'july271914', 'eluxify')
            ->create();
        User::factory()->predefinedUser('Zach Rancio', 'zach@gmail.com', 'Password@123', 'zachy')->create();
        User::factory()->predefinedUser('Jon Arvy Enriquez', 'arvy@gmail.com', 'Axelium0329', 'arvy')->create();
    }
}
