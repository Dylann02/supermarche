<?php

use CodeIgniter\Router\RouteCollection;
// use App\Controllers\ProduitController;
/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AccueilController::index');
$routes->post('accueil/valider', 'AccueilController::valider');
$routes->get('achat', 'AchatController::index');
$routes->post('achat/ajouter', 'AchatController::ajouter');