<?php
// index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once './Router.php';  // Include the router
require_once './controllers/Registration.php';  // Include the Registration controller
require_once './controllers/Login.php';  // Include the Registration controller
require_once './controllers/Dashboard.php';  // Include the Registration controller
require_once './routes.php';  // Include the routes

// Create a Router instance (defined in routes.php)
global $router;

// Get the current request method and URL
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Match the route with the request method and URL
$route = $router->matchRoute($requestMethod, $requestUrl);

// If a route match is found, call the controller and action
if ($route) {
    $controllerName = $route['controller'];
    $actionName = $route['action'];

    // Instantiate the controller
    $controller = new $controllerName();

    // Call the action
    $controller->$actionName();
} else {
    echo "404 Not Found";
}
?>
