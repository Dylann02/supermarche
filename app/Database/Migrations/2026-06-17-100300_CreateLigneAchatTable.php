<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLigneAchatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_achat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_produit' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantite' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'prix_unitaire' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('id_achat', 'achat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produit', 'produit', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ligne_achat');
    }

    public function down()
    {
        $this->forge->dropTable('ligne_achat');
    }
}
