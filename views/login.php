<?php


require('./Controllers/AuthManager.php');
require('./src/Models/Client.php');
require('./config/config.php');

session_start()

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
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <input type="submit">
    </form>
</body>

</html>

<?php



if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = new AuthManager($pdo);
    $res = $login->loginUser('Clients', $email, $password);
    if ($res) {
        $id = $res['ClientID'];
        $firstName = $res['FirstName'];
        $lastName = $res['LastName'];
        $_SESSION['username'] = $id . "_" . $firstName . "_" . $lastName;
        header("Location: dashboard");
    }
}
