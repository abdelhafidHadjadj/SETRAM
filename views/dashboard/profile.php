<?php

require('./src/Models/Client.php');
require('./config/config.php');


session_start();
session_regenerate_id();

if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];

$client = new Client('', '', '', '', '', '', '', '', '', '', '');
$clientData = $client->getClient($pdo, $id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>

<body>
    <form method="post">
        <div>
            <label for="">Firstname</label>
            <input type="text" name="firstName">
        </div>
        <div>
            <label for="">Lastname</label>
            <input type="text" name="lastName">
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Phone</label>
            <input type="phone" name="phone">
        </div>
        <div>
            <label for="">Photo</label>
            <input type="file">
        </div>
        <input type="submit" value="Save">
    </form>
</body>

</html>