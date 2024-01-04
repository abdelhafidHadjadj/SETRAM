<?php


require('./Controllers/AuthManager.php');
require('./config/config.php');
require('./src/Models/Client.php');

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="post">
        <input type="text" placeholder="FirstName" name="firstName" required>
        <input type="text" placeholder="LastName" name="lastName" require>
        <input type="tel" placeholder="Phone" name="phone" require>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit">
    </form>
</body>

</html>

<?php

if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $Auth = new AuthManager($pdo);
    $res = $Auth->registerClient($firstName, $lastName, $phone, $email, $password);
    if ($res) {
        $id = $res;
        $_SESSION['username'] = $id . "_" . $firstName . "_" . $lastName;
        header("Location: dashboard");
    }
}
