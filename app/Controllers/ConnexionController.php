<?php

namespace App\Controllers;

class ConnexionController extends BaseController
{
    public function index()
    {
        if (session()->has('utilisateur')) {
            return redirect()->to('/');
        }

        return view('Connexion');
    }


    public function verifier()
    {
        $identifiant = $this->request->getPost('identifiant');
        $motDePasse = $this->request->getPost('mot_de_passe');
        if ($identifiant === 'admin' && $motDePasse === '1234') {
            session()->set('utilisateur', [
                'identifiant' => $identifiant,
                'nom'        => 'Administrateur',
                'connecte_a' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/');
        }

        return redirect()->to('/connexion')->with('erreur', 'Identifiants incorrects. Veuillez réessayer.');
    }

    public function deconnecter()
    {
        session()->remove('utilisateur');
        session()->remove('caisse');

        return redirect()->to('/connexion')->with('message', 'Déconnexion effectuée.');
    }
}
