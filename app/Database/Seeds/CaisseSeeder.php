<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaisseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'numero'  => 1,
                'libelle' => 'Caisse 1',
            ],
            [
                'numero'  => 2,
                'libelle' => 'Caisse 2',
            ],
        ];

        $this->db->table('caisse')->insertBatch($data);
    }
}
