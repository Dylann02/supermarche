<?php

namespace App\Models;

use CodeIgniter\Model;

class CaisseModel extends Model
{
    protected $table         = 'caisse';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['numero', 'libelle'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'numero'  => 'required|integer',
        'libelle' => 'permit_empty|max_length[100]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}