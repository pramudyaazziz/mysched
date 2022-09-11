<?php

namespace Config;

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
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', function () {
    return redirect()->route('login');
});

$routes->get('/logout', 'Auth::logout', ['as' => 'logout']);

$routes->group('', ['filter' => 'isLoggedIn'], function ($routes) {
    $routes->get('/login', 'Auth::login', ['as' => 'login']);
    $routes->post('/login', 'Auth::loginProcess', ['as' => 'login.proses']);
    $routes->get('/register', 'Auth::register', ['as' => 'register']);
    $routes->post('/register', 'Auth::registerProcess', ['as' => 'register.proses']);
});


$routes->group('', ['filter' => 'isLoggedOut'], function ($routes) {
    $routes->get('/notepad', 'Notepad::index', ['as' => 'notepad']);
    $routes->post('/create-note', 'Notepad::create', ['as' => 'notepad.create']);
    $routes->get('/notepad/detail/(:segment)', 'Notepad::detail/$1');
    $routes->get('/notepad/edit/(:segment)', 'Notepad::edit/$1');
    $routes->post('/notepad/edit/(:segment)', 'Notepad::update/$1');
    $routes->delete('/notepad/delete/(:segment)', 'Notepad::delete/$1');
});

$routes->group('', ['filter' => 'isLoggedOut', 'namespace' => 'App\Controllers\Activity'], function ($routes) {
    //activity
    $routes->get('/activity', 'Activity::index', ['as' => 'activity']);
    $routes->post('/create-activity', 'Activity::create', ['as' => 'activity.create']);
    $routes->get('/activity/(:segment)', 'Activity::detail/$1');
    $routes->get('/activity-prev/(:segment)', 'Activity::prevDetail/$1');
    $routes->get('/activity/edit/(:segment)', 'Activity::edit/$1');
    $routes->post('/activity/update/(:segment)', 'Activity::update/$1');
    $routes->get('/activity-done/(:segment)', 'Activity::mark/$1');
    $routes->get('/activity-delete/(:segment)', 'Activity::delete/$1');


    //routines
    $routes->get('/routines', 'Routine::index', ['as' => 'routine']);
    $routes->post('/routines', 'Routine::create', ['as' => 'routine.create']);
    $routes->get('/routines/edit/(:segment)', 'Routine::edit/$1', ['as' => 'routine.edit']);
    $routes->post('/routines/update/(:segment)', 'Routine::update/$1');
    $routes->get('/routines/delete/(:segment)', 'Routine::delete/$1');
});

$routes->group('', ['filter' => 'isLoggedOut'], function ($routes) {
    $routes->get('/home', 'home', ['as' => 'home']);
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
