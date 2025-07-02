<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Auth Routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// Protected Routes (require login)
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard
    $routes->get('/dashboard', 'DashboardController::index');

    // Configurações / Sobre o Sistema
    $routes->get('/settings', 'DashboardController::settings');

    // Relatório de Reservas por Sala
    $routes->get('/reports', 'DashboardController::reports');

    // Exportação do Relatório (Novo!)
    $routes->get('/reports/export-csv', 'DashboardController::exportReportCsv');
    $routes->get('/reports/export-pdf', 'DashboardController::exportReportPdf');

    // Users
    $routes->get('/users', 'UserController::index');

    // Profile
    $routes->get('/profile', 'UserController::profile');

    // Rooms
    $routes->get('/rooms', 'RoomController::index');
    $routes->get('/rooms/create', 'RoomController::create');
    $routes->post('/rooms/store', 'RoomController::store');
    $routes->get('/rooms/edit/(:num)', 'RoomController::edit/$1');
    $routes->post('/rooms/update/(:num)', 'RoomController::update/$1');
    $routes->get('/rooms/delete/(:num)', 'RoomController::delete/$1');

    // Reservations
    $routes->get('/reservations', 'ReservationController::index');
    $routes->get('/reservations/create', 'ReservationController::create');
    $routes->post('/reservations/store', 'ReservationController::store');

    // My Reservations
    $routes->get('/my-reservations', 'ReservationController::myReservations');

    // Export Reservations CSV
    $routes->get('/reservations/export-csv', 'ReservationController::exportCsv');
});
