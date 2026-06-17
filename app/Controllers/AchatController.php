<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\LigneAchatModel;
use App\Models\ProduitModel;

class AchatController extends BaseController
{
    public function index()
    {
        $caisse = session()->get('caisse');

        if (! $caisse) {
            return redirect()->to('/')->with('erreur', "Veuillez d'abord choisir une caisse.");
        }

        $achatModel      = new AchatModel();
        $produitModel    = new ProduitModel();
        $ligneAchatModel = new LigneAchatModel();

        $achat = $achatModel->getAchatEnCours($caisse['id']);

        if (! $achat) {
            $idAchat = $achatModel->insert([
                'id_caisse'  => $caisse['id'],
                'date_achat' => date('Y-m-d H:i:s'),
                'statut'     => 'en_cours',
                'total'      => 0,
            ]);
            $achat = $achatModel->find($idAchat);
        }

        $data['caisse']   = $caisse;
        $data['achat']    = $achat;
        $data['produits'] = $produitModel->orderBy('designation', 'ASC')->findAll();
        $data['lignes']   = $ligneAchatModel->getLignesAvecProduit($achat['id']);

        return view('SaisieAchat', $data);
    }

    public function ajouter()
    {
        $caisse = session()->get('caisse');

        if (! $caisse) {
            return redirect()->to('/');
        }

        $idProduit = $this->request->getPost('id_produit');
        $quantite  = (int) $this->request->getPost('quantite');

        if (empty($idProduit) || $quantite <= 0) {
            return redirect()->to('/achat')->with('erreur', 'Veuillez choisir un produit et une quantité valide.');
        }

        $achatModel      = new AchatModel();
        $produitModel    = new ProduitModel();
        $ligneAchatModel = new LigneAchatModel();

        $achat   = $achatModel->getAchatEnCours($caisse['id']);
        $produit = $produitModel->find($idProduit);

        if (! $achat || ! $produit) {
            return redirect()->to('/achat')->with('erreur', 'Achat ou produit introuvable.');
        }

        $ligneAchatModel->insert([
            'id_achat'      => $achat['id'],
            'id_produit'    => $produit['id'],
            'quantite'      => $quantite,
            'prix_unitaire' => $produit['prix'],
            'montant'       => $produit['prix'] * $quantite,
        ]);

        $achatModel->recalculerTotal($achat['id']);

        return redirect()->to('/achat');
    }
}