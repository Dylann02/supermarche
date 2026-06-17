<?php

namespace App\Models;

use CodeIgniter\Model;

class LigneAchatModel extends Model
{
    protected $table         = 'ligne_achat';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_achat', 'id_produit', 'quantite', 'prix_unitaire', 'montant'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_achat'      => 'required|integer',
        'id_produit'    => 'required|integer',
        'quantite'      => 'required|integer|greater_than[0]',
        'prix_unitaire' => 'required|numeric|greater_than_equal_to[0]',
        'montant'       => 'required|numeric|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * Retourne les lignes d'un achat avec la désignation du produit,
     * prêtes à afficher dans le tableau Produit / Prix Unit / Qté / Montant.
     */
    public function getLignesAvecProduit(int $idAchat): array
    {
        return $this->select('ligne_achat.*, produit.designation')
                    ->join('produit', 'produit.id = ligne_achat.id_produit')
                    ->where('ligne_achat.id_achat', $idAchat)
                    ->orderBy('ligne_achat.id', 'ASC')
                    ->findAll();
    }
}