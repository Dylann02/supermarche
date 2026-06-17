<?php

use CodeIgniter\Router\RouteCollection;
// use App\Controllers\ProduitController;
/**
 * @var RouteCollection $routes
 */

$routes->get('/connexion', 'ConnexionController::index');
$routes->post('connexion/verifier', 'ConnexionController::verifier');
$routes->get('deconnecter', 'ConnexionController::deconnecter');

$routes->get('/', 'AccueilController::index');
$routes->post('accueil/valider', 'AccueilController::valider');
$routes->get('achat', 'AchatController::index');
$routes->post('achat/ajouter', 'AchatController::ajouter');
$routes->post('achat/cloture', 'AchatController::cloture');