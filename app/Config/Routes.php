<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Authentication Routes
$routes->get('/sign-up', 'AuthController::signUpView', ['filter' => 'guest']);
$routes->post('/sign-up', 'AuthController::signUp');
$routes->get('/sign-in', 'AuthController::signInView', ['filter' => 'guest']);
$routes->post('/sign-in', 'AuthController::signIn');
$routes->get('/sign-out', 'AuthController::signOut');
$routes->get('/verify-email/(:any)', 'AuthController::verifyEmail/$1');

$routes->get('/password/forgot', 'AuthController::passwordForgotView');
$routes->get('/password/forgot-password-email-send', 'AuthController::forgotPasswordEmailSend');
$routes->get('/password/forgot/(:any)', 'AuthController::passwordChangeView/$1');
$routes->post('/password/change', 'AuthController::passwordChange');


// All public pages
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'HomeController::about');
$routes->get('/contact', 'HomeController::contact');
$routes->post('/contact', 'HomeController::contactSubmit');
$routes->get('/posts', 'HomeController::posts');
$routes->get('/posts/(:any)', 'HomeController::showPost/$1');

// Normal User
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/profile', 'ProfileController::index');
    $routes->get('/auth/change-password', 'AuthController::changePasswordView');
    $routes->post('/auth/change-password', 'AuthController::changePassword');
    $routes->get('/profile/posts', 'UserPostController::index');
});

// Admin User
$routes->group('/dashboard', ['filter' => 'admin'], function ($routes) {
    $routes->get('', 'Admin\DashboardController::index');

    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->post('categories/get', 'Admin\CategoryController::get');
    $routes->get('categories/create', 'Admin\CategoryController::create');
    $routes->post('categories', 'Admin\CategoryController::store');
    $routes->get('categories/(:any)', 'Admin\CategoryController::show/$1');
    $routes->patch('categories/(:any)', 'Admin\CategoryController::update/$1');
    $routes->delete('categories/(:any)', 'Admin\CategoryController::delete/$1');

    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/create', 'Admin\UserController::create');
    $routes->post('users', 'Admin\UsersController::store');
    $routes->get('users/(:any)', 'Admin\UserController::show/$1');
    $routes->patch('users/(:any)', 'Admin\UserController::update/$1');
    $routes->delete('users/(:any)', 'Admin\UserController::delete/$1');

    $routes->get('posts', 'Admin\PostController::index');
    $routes->get('posts/create', 'Admin\PostController::create');
    $routes->post('posts', 'Admin\PostController::store');
    $routes->get('posts/(:any)', 'Admin\PostController::show/$1');
    $routes->patch('posts/(:any)', 'Admin\PostController::update/$1');
    $routes->delete('posts/(:any)', 'Admin\PostController::delete/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
