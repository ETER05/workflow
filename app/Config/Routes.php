<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //login
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
//profile
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/update', 'Profile::update');
$routes->post('/profile/updateProcess', 'Profile::updateProcess');
//admin
$routes->get('/admin', 'Admin::index');
//attendance
$routes->get('/attendance', 'Attendance::index');
$routes->post('/attendance/checkin', 'Attendance::checkin');
$routes->post('/attendance/checkout', 'Attendance::checkout');
//employee
$routes->get('/employee', 'Employee::add');
$routes->post('/employee/addprocess', 'Employee::addprocess');
$routes->get('/employee/edit/(:segment)', 'Employee::edit/$1');
$routes->post('/employee/editprocess/(:segment)', 'Employee::editprocess/$1');
$routes->get('/employee/delete/(:segment)', 'Employee::delete/$1');
//department
$routes->get('/department', 'Department::index');
$routes->get('/department/add', 'Department::add');
$routes->post('/department/addprocess', 'Department::addprocess');
$routes->get('/department/edit/(:segment)', 'Department::edit/$1');
$routes->post('/department/editprocess/(:segment)', 'Department::editprocess/$1');
$routes->get('/department/delete/(:segment)', 'Department::delete/$1');
//client
$routes->get('/client', 'Client::index');
$routes->get('/client/add', 'Client::add');
$routes->post('/client/addprocess', 'Client::addprocess');
$routes->get('/client/edit/(:segment)', 'Client::edit/$1');
$routes->post('/client/editprocess/(:segment)', 'Client::editprocess/$1');
$routes->get('/client/delete/(:segment)', 'Client::delete/$1');
//overtime
$routes->get('/overtime', 'Overtime::index');
$routes->get('/overtime/add', 'Overtime::add');
$routes->post('/overtime/addprocess', 'Overtime::addprocess');
$routes->get('/overtime/delete/(:segment)', 'Overtime::delete/$1');
$routes->get('/overtime/approval', 'Overtime::approval');
$routes->get('/overtime/approve/(:segment)', 'Overtime::approve/$1');
$routes->get('/overtime/reject/(:segment)', 'Overtime::reject/$1');
//leave
$routes->get('/leave', 'Leave::index');
$routes->get('/leave/add', 'Leave::add');
$routes->post('/leave/addprocess', 'Leave::addprocess');
$routes->get('/leave/delete/(:segment)', 'Leave::delete/$1');
$routes->get('/leave/approval', 'Leave::approval');
$routes->get('/leave/approve/(:segment)', 'Leave::approve/$1');
$routes->get('/leave/reject/(:segment)', 'Leave::reject/$1');
//project
$routes->get('/project', 'Project::index');
$routes->get('/project/add', 'Project::add');
$routes->post('/project/addprocess', 'Project::addprocess');
$routes->get('/project/edit/(:segment)', 'Project::edit/$1');
$routes->post('/project/editprocess/(:segment)', 'Project::editprocess/$1');
$routes->get('/project/delete/(:segment)', 'Project::delete/$1');
$routes->get('/project/view/(:segment)', 'Project::view/$1');
$routes->post('/project/upload/(:num)', 'Project::upload/$1');
$routes->get('/project/download/(:num)/(:any)', 'Project::download/$1/$2');
$routes->get('/project/deletefile/(:num)/(:num)', 'Project::deletefile/$1/$2');

//working on it

$routes->get('/finance', 'Finance::index');
