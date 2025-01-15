<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appel de tous les seeders nécessaires pour les tests ou la base de données
        $this->call('BrandSeed');
        $this->call('CarModelSeed');
        $this->call('CitySeed');
        $this->call('Color');
    }
}