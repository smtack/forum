<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::home');
$routes->get('/search', 'Home::search');

$routes->get('user/(:num)', 'User::index/$1');

$routes->get('update-profile', 'User::update', ['filter' => 'auth']);
$routes->post('user/update-profile', 'User::updateProfile', ['filter' => 'auth']);
$routes->post('user/update-avatar', 'User::updateAvatar', ['filter' => 'auth']);
$routes->post('user/update-password', 'User::updatePassword', ['filter' => 'auth']);
$routes->post('user/delete-profile', 'User::deleteProfile', ['filter' => 'auth']);

$routes->get('category/(:num)', 'Category::index/$1');

$routes->presenter('topic');
$routes->presenter('post');

$routes->get('/signup', 'Auth::signup');
$routes->post('/signup', 'Auth::register');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('home', 'Admin::home');

    $routes->get('users', 'User::index');

    $routes->get('login', 'Auth::login');

    $routes->presenter('category');

    $routes->get('make-moderator/(:num)', 'Moderator::makeModerator/$1');
    $routes->get('remove-moderator/(:num)', 'Moderator::removeModerator/$1');
});