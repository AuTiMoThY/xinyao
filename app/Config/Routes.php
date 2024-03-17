<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('Test', 'Test::index');

$routes->get('/', 'Frontend\Xinyao::index/1', ['filter' => 'auth']);
$routes->get('login', 'Frontend\Login::index');
$routes->get('logout', 'Frontend\Login::logout');

$routes->post('api/login', 'Frontend\Login::apiLogin');


$routes->get('xinyao-1', 'Frontend\Xinyao::index/1', ['filter' => 'auth']);
$routes->get('xinyao-1/(:any)', 'Frontend\Xinyao::index/1/$1', ['filter' => 'auth']);
$routes->get('xinyao-2', 'Frontend\Xinyao::index/2', ['filter' => 'auth']);
$routes->get('xinyao-3', 'Frontend\Xinyao::index/3', ['filter' => 'auth']);

$routes->get('cart', 'Frontend\Cart::index', ['filter' => 'auth']);
$routes->get('cart2', 'Frontend\Cart::cart2', ['filter' => 'auth']);
$routes->get('history', 'Frontend\History::index', ['filter' => 'auth']);
$routes->get('favourite', 'Frontend\Favourite::index', ['filter' => 'auth']);
