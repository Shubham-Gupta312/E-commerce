<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('admin/register', 'AuthController::register');
$routes->post('admin/register', 'AuthController::register');
$routes->get('admin/login', 'AuthController::login');
$routes->post('admin/login', 'AuthController::login');
$routes->get('admin/logout', 'AuthController::logout');

$routes->group('admin', static function ($routes) {
    $routes->get('dashboard', 'Home::dashboard');

    $routes->get('categories', 'Home::categories');
    $routes->post('categories', 'Home::categories');
    $routes->get('fetchdata', 'Home::fetchCategories');
    $routes->post('catStatus', 'Home::CatStatus');
    $routes->post('editCategory', 'Home::editCategory');
    $routes->post('updateCategory', 'Home::updateCategory');
    $routes->post('deleteCategory', 'Home::deleteCategory');

    $routes->get('classification', 'Home::Classification');
    $routes->post('categorization', 'Home::Classification');
    $routes->get('fetchClassification', 'Home::fetchClassification');
    $routes->post('editCategorization', 'Home::editCategorization');
    $routes->post('updateCategorization', 'Home::updateCategorization');
    $routes->post('deleteCategorization', 'Home::deleteCategorization');
    
    $routes->get('products', 'Home::Products');
    $routes->post('fetchcatvariant', 'Home::fetchcatvariant');
});
