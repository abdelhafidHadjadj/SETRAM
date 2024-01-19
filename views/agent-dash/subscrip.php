<?php
require('./config/config.php');
require('./src/Models/Client.php');
require('./src/Models/Agent.php');



session_start();
session_regenerate_id();


if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: agent/login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Agent</title>
</head>

<body class="bg-violet-100">
    <section class="flex ">
        <div>
            <?php require('./views/component/SideBarAg.php'); ?>
        </div>
    </section>
</body>

</html>