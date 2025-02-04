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
        User::factory()->predefinedUser('Irhene', 'irhene123@gmail.com', '87654321', 'irhene')->create();
        User::factory()->predefinedUser('Lance Ong', 'lance123@gmail.com', 'Password@123', 'lance')->create();
        User::factory()->predefinedUser('BCP MV', 'jhai1@gmail.com', 'Password@123', 'bcpmv')->create();
        User::factory()->predefinedUser('BCP MAIN', 'jhai2@gmail.com', 'Password@123', 'bcpmain')->create();
        User::factory()->predefinedUser('BCP BULACAN', 'jhai3@gmail.com', 'Password@123', 'bcpbulacan')->create();
        User::factory()->predefinedUser('BCP ANNEX', 'jhai4@gmail.com', 'Password@123', 'bcpannex')->create();
        User::factory()->predefinedUser('BCP HD', 'jhai5@gmail.com', 'Password@123', 'bcphd')->create();
        User::factory()->predefinedUser('BCP CRIM', 'jhai6@gmail.com', 'Password@123', 'bcpcrim')->create();
    }
}
