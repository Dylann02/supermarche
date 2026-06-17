<?php

namespace App\Controllers;

use App\Models\CaisseModel;

class AccueilController extends BaseController
{
    /**
     * Affiche l'écran d'accueil avec la liste déroulante des caisses.
     */
    public function index()
    {
        $caisseModel = new CaisseModel();

        $data['caisses'] = $caisseModel->orderBy('numero', 'ASC')->findAll();

        return view('ChoisirCaisse', $data);
    }

    /**
     * Traite la validation du formulaire : vérifie la caisse choisie,
     * la stocke en session, puis redirige vers la page de saisie des achats.
     */
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

        // On stocke la caisse choisie en session pour pouvoir
        // l'afficher sur les pages suivantes (au-dessus du menu).
        session()->set('caisse', $caisse);

        return redirect()->to('/achat');
    }
}