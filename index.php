<?php
session_start();
require_once '../config/constants.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

$controller = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
$controller = rtrim($controller, '/');
$controller = explode('/', $controller);

if (empty($controller[0])) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit();
}

$controllerName = ucfirst($controller[0]) . 'Controller';
$method = isset($controller[1]) ? $controller[1] : 'index';
$params = array_slice($controller, 2);

$controllerFile = CONTROLLERS_PATH . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo '404 - Page Not Found';
    exit();
}

require_once $controllerFile;
$controllerInstance = new $controllerName();

if (!method_exists($controllerInstance, $method)) {
    http_response_code(404);
    echo '404 - Method Not Found';
    exit();
}

call_user_func_array([$controllerInstance, $method], $params);
