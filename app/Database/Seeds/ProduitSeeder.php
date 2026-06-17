<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'designation'    => 'Lait 1L',
                'prix'           => 1.50,
                'quantite_stock' => 50,
            ],
            [
                'designation'    => 'Pain Baguette',
                'prix'           => 0.90,
                'quantite_stock' => 30,
            ],
            [
                'designation'    => 'Fromage 200g',
                'prix'           => 3.50,
                'quantite_stock' => 20,
            ],
            [
                'designation'    => 'Oeufs x12',
                'prix'           => 2.80,
                'quantite_stock' => 25,
            ],
            [
                'designation'    => 'Jambon 200g',
                'prix'           => 4.20,
                'quantite_stock' => 15,
            ],
        ];

        $this->db->table('produit')->insertBatch($data);
    }
}
