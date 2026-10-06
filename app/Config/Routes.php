<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); 
$routes->get('/home', 'Home::index');
$routes->get('/about', 'About::index'); 
$routes->get('/services', 'Services::index'); 
$routes->match(['get', 'post'], '/contact', 'Contact::index'); 
$routes->get('/register', 'Register::index'); 
$routes->post('/register', 'Register::create'); 
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('accounts', 'Accounts::index');
$routes->get('accounts.php', 'Accounts::index');
$routes->get('accounts/viewAccount/(:num)', 'Accounts::viewAccount/$1');
$routes->get('account/(:num)', 'Accounts::viewAccount/$1');
$routes->get('logout', 'Login::logout');
$routes->get('accounts/new', 'Accounts::createForm');
$routes->post('accounts/create', 'Accounts::create');
$routes->get('accounts/edit/(:num)', 'Accounts::edit/$1');
$routes->post('accounts/update/(:num)', 'Accounts::update/$1');
$routes->post('accounts/delete/(:num)', 'Accounts::delete/$1');