<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table         = 'produit';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['designation', 'prix', 'quantite_stock'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'designation'    => 'required|min_length[2]|max_length[150]',
        'prix'           => 'required|numeric|greater_than_equal_to[0]',
        'quantite_stock' => 'required|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}