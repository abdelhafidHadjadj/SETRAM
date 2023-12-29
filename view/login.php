<?php


require('./Controllers/AuthManager.php');
require('./src/Models/Client.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <form method="post">
        <input type="text" placeholder="FirstName">
        <input type="text" placeholder="LastName">
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Password">
        <input type="submit">
    </form>
</body>

</html>

<?php

if (isset($_POST['FirstName'])) {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}
