<?php
$config = require __DIR__ . '/../app/config/config.php';
session_name($config['app']['session_name']);
session_start();

require_once __DIR__ . '/../app/core/Auth.php';
$route = $_GET['route'] ?? 'dashboard';

$routes = [
    'login' => ['AuthController', 'login'],
    'logout' => ['AuthController', 'logout'],
    'dashboard' => ['DashboardController', 'index'],
    'students' => ['StudentsController', 'index'],
    'employees' => ['EmployeesController', 'index'],
    'inventory' => ['InventoryController', 'index'],
    'visits' => ['VisitsController', 'index'],
    'consultations' => ['ConsultationsController', 'index'],
    'consultations/patient-search' => ['ConsultationsController', 'patientSearch'],
    'borrowing' => ['BorrowingController', 'index'],
    'first-aid' => ['FirstAidController', 'index'],
];

if (!isset($routes[$route])) {
    http_response_code(404);
    echo 'Page not found';
    exit;
}

[$controllerName, $method] = $routes[$route];
require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->$method();
