<?php


require('./src/Models/Subscription.php');
require('./src/Models/Client.php');

session_start();
session_regenerate_id();

if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: login");
}
