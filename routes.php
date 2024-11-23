<?php
// routes.php

// Include Router class
require_once 'Router.php';

// Initialize the Router
$router = new Router();

// Add routes
$router->addRoute('GET', '/home', 'Dashboard', 'index'); // Define the root route
$router->addRoute('GET', '/register-user', 'Registration', 'index'); // Define the root route
$router->addRoute('GET', '/login-user', 'Login', 'index'); // Define the root route
$router->addRoute('GET', '/logout', 'Login', 'logout'); // Define the root route

// $router->addRoute('GET', '/register', 'Registration', 'index'); // Registration form
$router->addRoute('POST', '/register', 'Registration', 'register'); // Handle form submission
$router->addRoute('POST', '/user-login', 'Login', 'userLogin'); // Handle form submission

// You can add more routes here as your application grows
