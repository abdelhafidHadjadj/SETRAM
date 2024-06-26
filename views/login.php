<?php
require('./Controllers/AuthManager.php');
require('./config/config.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/connexion.css">
    <link rel="stylesheet" href="../../style/style.css">
    <title>login</title>
</head>

<section class="loginSection">

    <div class="firstPart">
        <div class="logoBox">
            <img src="../assets/logo-setram.png" alt="">
        </div>
        <div class="formBox">
            <h2>Login into your Account</h2>

            <form method="post">
                <div class="inputBox">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="inputBox">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="checkTermsBox">
                    <input type="checkbox" name="" id="">
                    <p>Remeber Password</p>
                </div>
                <input type="submit" class="btnSubmit">

                <div class="alreadyExistBox">
                    <p>You dont have an Account <a href="http://localhost:8000/register">?Register</a> </p>
                </div>
            </form>
        </div>
    </div>
    <div class="secondPart">

    </div>
</section>

</html>

<?php



if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $email;
    $login = new AuthManager($pdo);
    $res = $login->loginUser('Clients', $email, $password);
    if ($res) {
        echo $res;
        $id = $res['ClientID'];
        $firstName = $res['FirstName'];
        $lastName = $res['LastName'];
        $_SESSION['username'] = $id . "_" . $firstName . "_" . $lastName;
        header("Location: /dashboard/dashboard");
    }
}
