<?php

require_once('./config/config.php');
require('./Controllers/DatabaseManager.php');
require('./Controllers/QueryManager.php');


DataBaseManger::createTables($pdo);

include './src/Models/Router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);
$router->get('/', './views/home');
$router->get('/login', './views/login');
$router->get('/register', './views/register');
$router->get('/dashboard/dashboard', './views/dashboard/dashboard');
$router->get('/dashboard/profile', './views/dashboard/profile');
$router->get('/dashboard/subscription', './views/dashboard/subscripe');
$router->get('/dashboard/mycard', './views/dashboard/myCard');

// Admins router
$router->get('/admin/login', './views/admin-dash/login');
$router->get('/admin/profile', './views/admin-dash/profile');
$router->get('/admin/clients', './views/admin-dash/clients');
$router->get('/admin/agents', './views/admin-dash/agents');

// Agents Router

$router->get('/agent/login', './views/agent-dash/login');
$router->get('/agent/clients', './views/agent-dash/client');
$router->get('/agent/profile', './views/agent-dash/profile');
$router->get('/agent/cards', './views/agent-dash/cards');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/style/sidebar.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>index</title>
</head>


</html>