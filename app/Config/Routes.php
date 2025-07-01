<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/callback', 'Auth::callback');
$routes->get('dashboard', 'Dashboard::index');
$routes->post('dashboard/savePhone', 'Dashboard::savePhone');
$routes->get('auth/logout', 'Auth::logout');
