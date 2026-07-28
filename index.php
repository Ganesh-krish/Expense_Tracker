<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/routes/web.php';

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Lax');
if (APP_ENV === 'production') {
    ini_set('session.cookie_secure', 1);
}
session_start();

$method = $_SERVER['REQUEST_METHOD'];
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard';

if (empty($url)) {
    header('Location: ' . BASE_URL . 'dashboard');
    exit();
}

// Try route map first
foreach ($routes as $routePattern => $target) {
    $parts = explode(':', $routePattern, 2);
    $routeMethod = $parts[0] ?? '';
    $routePath = $parts[1] ?? '';

    if ($routeMethod !== $method) {
        continue;
    }

    $regex = '#^' . preg_replace('/\{([^}]+)\}/', '([^/]+)', $routePath) . '$#';
    if (preg_match($regex, $url, $matches)) {
        [$controllerName, $action] = explode('@', $target);
        $controllerFile = CONTROLLERS_PATH . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo '404 - Controller Not Found';
            exit();
        }

        require_once $controllerFile;
        $instance = new $controllerName();

        if (!method_exists($instance, $action)) {
            http_response_code(404);
            echo '404 - Method Not Found';
            exit();
        }

        $params = [];
        preg_match_all('/\{([^}]+)\}/', $routePath, $paramNames);
        if (!empty($paramNames[1])) {
            foreach ($paramNames[1] as $index => $name) {
                $params[$name] = $matches[$index + 1] ?? null;
            }
        }

        call_user_func_array([$instance, $action], $params);
        exit();
    }
}

// Fallback: segment-based dispatch
$segments = explode('/', $url);
$controllerName = ucfirst($segments[0]) . 'Controller';
$action = $segments[1] ?? 'index';
$params = array_slice($segments, 2);

$controllerFile = CONTROLLERS_PATH . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo '404 - Page Not Found';
    exit();
}

require_once $controllerFile;
$controllerInstance = new $controllerName();

if (!method_exists($controllerInstance, $action)) {
    http_response_code(404);
    echo '404 - Method Not Found';
    exit();
}

call_user_func_array([$controllerInstance, $action], $params);
