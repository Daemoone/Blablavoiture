<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarModelSeed extends Seeder
{
    public function run()
    {
        $data = [
            ['name'=>'Brera','id_brand'=>1],
            ['name'=>'GT','id_brand'=>1],
            ['name'=>'Giulia','id_brand'=>1],
            ['name'=>'Giulietta','id_brand'=>1],
            ['name'=>'A1','id_brand'=>2],
            ['name'=>'A3','id_brand'=>2],
            ['name'=>'A5','id_brand'=>2],
            ['name'=>'A6','id_brand'=>2],
            ['name'=>'A7','id_brand'=>2],
            ['name'=>'TT','id_brand'=>2],
            ['name'=>'I3','id_brand'=>3],
            ['name'=>'I4','id_brand'=>3],
            ['name'=>'Serie 3','id_brand'=>3],
            ['name'=>'Serie 4','id_brand'=>3],
            ['name'=>'Blazer','id_brand'=>4],
            ['name'=>'Camaro','id_brand'=>4],
            ['name'=>'Corvette','id_brand'=>4],
            ['name'=>'2CV','id_brand'=>5],
            ['name'=>'Berlingo','id_brand'=>5],
            ['name'=>'C2','id_brand'=>5],
            ['name'=>'C3','id_brand'=>5],
            ['name'=>'C3 Picasso','id_brand'=>5],
            ['name'=>'C3 Pluriel','id_brand'=>5],
            ['name'=>'C4','id_brand'=>5],
            ['name'=>'Jumpy','id_brand'=>5],
            ['name'=>'Dokker','id_brand'=>6],
            ['name'=>'Duster','id_brand'=>6],
            ['name'=>'Jogger','id_brand'=>6],
            ['name'=>'Lodgy','id_brand'=>6],
            ['name'=>'Logan','id_brand'=>6],
            ['name'=>'Sandero','id_brand'=>6],
            ['name'=>'Spring','id_brand'=>6],
            ['name'=>'Panda','id_brand'=>7],
            ['name'=>'Punto','id_brand'=>7],
            ['name'=>'500','id_brand'=>7],
            ['name'=>'Fiesta','id_brand'=>8],
            ['name'=>'Focus','id_brand'=>8],
            ['name'=>'Galaxy','id_brand'=>8],
            ['name'=>'Explorer','id_brand'=>8],
            ['name'=>'Jazz','id_brand'=>9],
            ['name'=>'Civic','id_brand'=>9],
            ['name'=>'CRV','id_brand'=>9],
        ];
        $this->db->table('modelcar')->insertBatch($data);
    }
}
