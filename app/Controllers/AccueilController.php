<?php

namespace App\Controllers;

use App\Models\CaisseModel;

class AccueilController extends BaseController
{
    public function index()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('utilisateur')) {
            return redirect()->to('/connexion');
        }

        $caisseModel = new CaisseModel();

        $data['caisses'] = $caisseModel->orderBy('numero', 'ASC')->findAll();

        return view('ChoisirCaisse', $data);
    }

    public function valider()
    {
        $idCaisse = $this->request->getPost('id_caisse');

        if (empty($idCaisse)) {
            return redirect()->to('/')->with('erreur', 'Veuillez choisir une caisse.');
        }

        $caisseModel = new CaisseModel();
        $caisse      = $caisseModel->find($idCaisse);

        if (! $caisse) {
            return redirect()->to('/')->with('erreur', 'Caisse introuvable.');
        }
        session()->set('caisse', $caisse);

        return redirect()->to('/achat');
    }
}