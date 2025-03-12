<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandSeed extends Seeder
{
    public function run()
    {
        $data = [
            ['name'=>'Alfa Romeo'],
            ['name'=>'Audi'],
            ['name'=>'BMW'],
            ['name'=>'Chevrolet'],
            ['name'=>'Citroen'],
            ['name'=>'Dacia'],
            ['name'=>'Fiat'],
            ['name'=>'Ford'],
            ['name'=>'Honda'],
            ['name'=>'Hyundai'],
            ['name'=>'Isuzu'],
            ['name'=>'Jaguar'],
            ['name'=>'Jeep'],
            ['name'=>'Kia'],
            ['name'=>'Land Rover'],
            ['name'=>'Mazda'],
            ['name'=>'Mercedes'],
            ['name'=>'Mitsubishi'],
            ['name'=>'Nissan'],
            ['name'=>'Opel'],
            ['name'=>'Peugeot'],
            ['name'=>'Renault'],
            ['name'=>'Saab'],
            ['name'=>'Seat'],
            ['name'=>'Skoda'],
            ['name'=>'Tesla'],
            ['name'=>'Toyata'],
            ['name'=>'Volkswagen'],
            ['name'=>'Volvo'],
        ];
        $this->db->table('brand')->insertBatch($data);
    }
}
