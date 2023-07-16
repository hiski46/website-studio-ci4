<?php

namespace Config;

use App\Controllers\Auth;
use App\Controllers\LandingController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('auth', static function ($routes) {
    $routes->get('(:any)', 'Auth::$1');
    $routes->post('(:any)', 'Auth::$1');
    $routes->get('', 'Auth::index');
    $routes->add('login', 'Auth::login');
    // $routes->post('deactivate/(:any)', 'Auth::deactivate/$1');
    // $routes->get('logout', 'Auth::logout', ['filter' => 'login']);
});
$routes->get('dashboard', 'Home::index');
$routes->get('/', 'LandingController::index');

$routes->group('landingpage', static function ($routes) {
    $routes->get('paket', 'LandingController::paket');
    $routes->get('detail-paket/(:num)', 'LandingController::detailPaket/$1');
    $routes->get('cart', 'LandingController::cart');
    $routes->post('checkout', 'LandingController::checkout');
});

$routes->group('paket', static function ($routes) {
    $routes->get('list', 'PaketController::index');
    $routes->get('add', 'PaketController::halamanTambah');
    $routes->post('add', 'PaketController::tambah');
    $routes->get('edit/(:num)', 'PaketController::halamanEdit/$1');
    $routes->post('edit/(:num)', 'PaketController::edit/$1');
    $routes->get('delete/(:num)', 'PaketController::delete/$1');
    $routes->get('status-paket', 'PaketController::status');
});

$routes->group('transaksi', static function ($routes) {
    $routes->get('status', 'Home::statusTransaksi');
});
$routes->group('content', static function ($routes) {
    $routes->get('portofolio', 'ContentController::portofolio');
    $routes->get('portofolio/add', 'ContentController::halamanAddPortofolio');
    $routes->post('portofolio/add', 'ContentController::addPortofolio');
    $routes->get('portofolio/edit/(:num)', 'ContentController::halamanEditPortofolio/$1');
    $routes->post('portofolio/edit/(:num)', 'ContentController::EditPortofolio/$1');
    $routes->get('portofolio/delete-foto/(:num)', 'ContentController::deleteFoto/$1');
    $routes->get('portofolio/status', 'ContentController::statusPortofolio');
    $routes->get('portofolio/delete/(:any)', 'ContentController::deletePortofolio/$1');
    $routes->get('biodata', 'ContentController::biodata');
    $routes->post('biodata/simpan', 'ContentController::biodataSave');
    $routes->get('carousel', 'ContentController::carousel');
    $routes->get('carousel/tambah', 'ContentController::halamanTambahCarousel');
    $routes->post('carousel/tambah', 'ContentController::tambahCarousel');
    $routes->get('carousel/delete/(:num)', 'ContentController::deleteCarousel/$1');
});





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
