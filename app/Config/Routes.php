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

$routes->group('admin',['filter' => 'IsAdminFilter'], static function ($routes) {
    $routes->get('dashboard', 'Home::dashboard');

    $routes->get('brand', 'Home::brand');
    $routes->post('brand', 'Home::brand');
    $routes->get('fetchBrandData', 'Home::fetchBrand');
    $routes->post('brandStatus', 'Home::brandStatus');
    $routes->post('editBrand', 'Home::editBrand');
    $routes->post('updateBrand', 'Home::updateBrand');
    $routes->post('deleteBrand', 'Home::deleteBrand');

    $routes->get('categories', 'Home::categories');
    $routes->post('categories', 'Home::categories');
    $routes->get('fetchdata', 'Home::fetchCategories');
    $routes->post('catStatus', 'Home::CatStatus');
    $routes->post('editCategory', 'Home::editCategory');
    $routes->post('updateCategory', 'Home::updateCategory');
    $routes->post('deleteCategory', 'Home::deleteCategory');

    $routes->get('subCategory', 'Home::subCategory');
    $routes->post('subCategory', 'Home::subCategory');
    $routes->get('fetchSubCategory', 'Home::fetchSubCategory');
    $routes->post('subCatStatus', 'Home::subCatStatus');
    $routes->post('editSubCategory', 'Home::editSubCategory');
    $routes->post('updateSubCategory', 'Home::updateSubCategory');
    $routes->post('deleteSubCategory', 'Home::deleteSubCategory');

    $routes->get('unitMaster', 'Home::unitMaster');
    $routes->post('unitMaster', 'Home::unitMaster');
    $routes->get('fetchUnitMaster', 'Home::fetchUnitMaster');
    $routes->post('toggle_status', 'Home::toggle_status');
    $routes->post('editUnitMaster', 'Home::editUnitMaster');
    $routes->post('updateUnitMaster', 'Home::updateUnitMaster');
    $routes->post('deleteUnitMaster', 'Home::deleteUnitMaster');
    
    $routes->get('validateProductCode', 'Home::validate_ProductCode');
    $routes->post('fetchSubCategoryData', 'Home::fetchSubCategoryData');

    $routes->get('products', 'Home::Products');
    $routes->post('products', 'Home::Products');
    $routes->get('fetchproducts', 'Home::fetchproducts');
    $routes->post('productStatus', 'Home::productStatus');
    $routes->post('editProductData', 'Home::editProductData');


    // $routes->get('productImage', 'Home::productImage');
    // $routes->post('productImage', 'Home::productImage');
    // $routes->get('fetchproductImage', 'Home::fetchproductImage');

    // $routes->get('productDetail', 'Home::productDetail');
    // $routes->post('productDetail', 'Home::productDetail');
    // $routes->get('fetchproductDetail', 'Home::fetchproductDetail');

});
