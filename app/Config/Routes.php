<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/update', 'Profile::update'); // Untuk menampilkan form update
$routes->post('/profile/updateProcess', 'Profile::updateProcess'); // Untuk proses update data
$routes->get('/attendance', 'Attendance::index');
$routes->get('/project', 'Project::index');
$routes->get('/finance', 'Finance::index');
$routes->get('/overtime', 'Overtime::index');
$routes->get('/leave', 'Leave::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/addemployee', 'Employee::add');
$routes->post('/employee/addprocess', 'Employee::addprocess');
$routes->get('/employee/edit/(:segment)', 'Employee::edit/$1');
$routes->post('/employee/editprocess/(:segment)', 'Employee::editprocess/$1');
$routes->get('/employee/delete/(:segment)', 'Employee::delete/$1');
$routes->get('/departement', 'departement::index');