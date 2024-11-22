<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Color extends Seeder
{
    public function run()
    {
        $data = [
            ['name'=>'Blanc'],
            ['name'=>'Noir'],
            ['name'=>'Bleu marine'],
            ['name'=>'Bleu clair'],
            ['name'=>'Rouge vif'],
            ['name'=>'Rouge bordeaux'],
            ['name'=>'Gris clair'],
            ['name'=>'Gris anthracite'],
            ['name'=>'Argenté'],
            ['name'=>'Champagne'],
            ['name'=>'Vert foncé'],
            ['name'=>'Vert olive'],
            ['name'=>'Beige'],
            ['name'=>'Marron chocolat'],
            ['name'=>'Jaune vif'],
            ['name'=>'Orange métallisé'],
            ['name'=>'Violet profond'],
            ['name'=>'Bleu turquoise'],
            ['name'=>'Rose métallisé'],
            ['name'=>'Bleu électrique'],
            ['name'=>'Vert émeraude'],
            ['name'=>'Blanc nacré'],
            ['name'=>'Noir mat'],
            ['name'=>'Or métallisé'],
            ['name'=>'Cuivre'],
        ];
        $this->db->table('color')->insertBatch($data);
    }
}
