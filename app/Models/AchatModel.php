<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table         = 'achat';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_caisse', 'date_achat', 'statut', 'total'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_caisse'  => 'required|integer',
        'date_achat' => 'permit_empty|valid_date',
        'statut'     => 'permit_empty|in_list[en_cours,cloture]',
        'total'      => 'permit_empty|numeric',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * Retourne l'achat "en_cours" pour une caisse donnée,
     * ou null s'il n'y en a pas encore (il faut alors le créer).
     */
    public function getAchatEnCours(int $idCaisse): ?array
    {
        return $this->where('id_caisse', $idCaisse)
                    ->where('statut', 'en_cours')
                    ->orderBy('id', 'DESC')
                    ->first();
    }

    /**
     * Recalcule et met à jour le total d'un achat
     * à partir de la somme de ses lignes.
     */
    public function recalculerTotal(int $idAchat): void
    {
        $total = $this->db->table('ligne_achat')
                           ->selectSum('montant')
                           ->where('id_achat', $idAchat)
                           ->get()
                           ->getRow()
                           ->montant ?? 0;

        $this->update($idAchat, ['total' => $total]);
    }
}