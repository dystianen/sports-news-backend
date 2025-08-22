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

$routes->group('periods', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PeriodController::index');
  $routes->get('form', 'PeriodController::form');
  $routes->post('save', 'PeriodController::save');
  $routes->post('delete/(:num)', 'PeriodController::delete/$1');
});
