<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
  return redirect()->to('/login');
});

$routes->get('login', 'AuthController::login');
$routes->post('login/store', 'AuthController::loginStore');
$routes->get('logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']);

/** ================================= 
 *          WEB DASHBOARD
 * ================================== */
$routes->group('users', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'UserController::index');
  $routes->get('form', 'UserController::form');
  $routes->post('save', 'UserController::save');
  $routes->post('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('sports', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'SportController::index');
  $routes->get('form', 'SportController::form');
  $routes->post('save', 'SportController::save');
  $routes->post('delete/(:num)', 'SportController::delete/$1');
});

$routes->group('teams', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'TeamController::index');
  $routes->get('form', 'TeamController::form');
  $routes->post('save', 'TeamController::save');
  $routes->post('delete/(:num)', 'TeamController::delete/$1');
});

$routes->group('matches', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'MatchController::index');
  $routes->get('form', 'MatchController::form');
  $routes->post('save', 'MatchController::save');
  $routes->post('delete/(:num)', 'MatchController::delete/$1');
});
