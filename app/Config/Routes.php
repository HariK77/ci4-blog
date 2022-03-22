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
$routes->get('sign-up', 'AuthController::signUpView', ['filter' => 'guest']);
$routes->post('sign-up', 'AuthController::signUp', ['filter' => 'guest']);
$routes->get('sign-in', 'AuthController::signInView', ['filter' => 'guest']);
$routes->post('sign-in', 'AuthController::signIn', ['filter' => 'guest']);
$routes->get('sign-out', 'AuthController::signOut', ['filter' => 'auth']);
$routes->get('verify-email/(:any)', 'AuthController::verifyEmail/$1', ['filter' => 'guest']);
$routes->get('password/forgot', 'AuthController::passwordForgotView', ['filter' => 'guest']);
$routes->post('password/forgot', 'AuthController::sendPasswordResetEmail', ['filter' => 'guest']);
$routes->get('password/reset/(:any)', 'AuthController::passwordResetView/$1', ['filter' => 'guest']);
$routes->post('password/reset', 'AuthController::passwordReset', ['filter' => 'guest']);

// Authenticated -- Normal User
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Profile
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile', 'ProfileController::saveProfile');
    $routes->get('profile/change-password', 'ProfileController::changePasswordView');
    $routes->post('profile/change-password', 'ProfileController::changePassword');

    // posts
    $routes->get('posts', 'UserPostController::index');
    $routes->get('posts/create', 'UserPostController::create');
    $routes->post('posts', 'UserPostController::store');
    $routes->get('posts/edit/(:any)', 'UserPostController::edit/$1');
    $routes->get('posts/undo-delete/(:any)', 'UserPostController::undoDelete/$1');
    $routes->get('posts/(:any)', 'UserPostController::show/$1');
    $routes->patch('posts/(:any)', 'UserPostController::update/$1');
    $routes->delete('posts', 'UserPostController::delete');

    // upload images
    $routes->post('posts/upload-image', 'UserPostController::saveImage');
});

// Authenticated -- Admin User
$routes->group('dashboard', ['filter' => 'admin'], function ($routes) {
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
    $routes->post('users', 'Admin\UserController::store');
    $routes->get('users/edit/(:any)', 'Admin\UserController::edit/$1');
    $routes->get('users/enable/(:any)', 'Admin\UserController::enableUser/$1');
    $routes->get('users/(:any)', 'Admin\UserController::show/$1');
    $routes->patch('users/(:any)', 'Admin\UserController::update/$1');
    $routes->delete('users', 'Admin\UserController::delete');

    $routes->get('posts', 'Admin\PostController::index');
    $routes->post('posts/get', 'Admin\PostController::get');
    $routes->get('posts/create', 'Admin\PostController::create');
    $routes->post('posts', 'Admin\PostController::store');
    $routes->get('posts/(:any)', 'Admin\PostController::show/$1');
    $routes->patch('posts/(:any)', 'Admin\PostController::update/$1');
    $routes->delete('posts/(:any)', 'Admin\PostController::delete/$1');

});

// All guest pages
$routes->get('/', 'HomeController::index');
$routes->get('about', 'HomeController::about');
$routes->get('contact', 'HomeController::contact');
$routes->post('contact', 'HomeController::contactSubmit');
$routes->get('(:any)', 'HomeController::showPost/$1');

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
