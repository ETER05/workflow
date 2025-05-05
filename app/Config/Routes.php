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
$routes->get('/attendance', 'Attendance::index');
$routes->get('/project', 'Project::index');
$routes->get('/finance', 'Finance::index');
$routes->get('/overtime', 'Overtime::index');
$routes->get('/leave', 'Leave::index');