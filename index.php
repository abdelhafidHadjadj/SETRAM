<?php

require_once('./config/config.php');
require('./Controllers/DatabaseManager.php');
require('./Controllers/QueryManager.php');


DataBaseManger::createTables($pdo);

include './src/Models/Router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);
$router->get('/login', './views/login');
$router->get('/register', './views/register');
$router->get('/dashboard', './views/dashboard/dashboard');
$router->get('/dashboard/subscription', './views/dashboard/subscripe');
$router->get('/dashboard/profile', './views/dashboard/profile');
