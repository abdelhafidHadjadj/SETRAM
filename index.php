<?php

require_once('./config/config.php');
require('./Controllers/DatabaseManager.php');
require('./Controllers/QueryManager.php');


DataBaseManger::createTables($pdo);

include './src/Models/Router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);
$router->get('/setram/', './view/login');
$router->get('/setram/register', './view/register');
