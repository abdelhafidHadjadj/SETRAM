<?php
session_start();
session_regenerate_id();

if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];

// hna nb3t request to db bch n recuperer data t3 user

echo "Hellooo from dash" . "_" . $id;
