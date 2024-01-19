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
    <link rel="stylesheet" href="../style/connexion.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>

<body>
    <section class="loginSection">

        <div class="firstPart">
            <div class="logoBox">
                <img src="../assets/logo-setram.png" alt="">
            </div>
            <div class="formBox">
                <h2 class="text-xl font-semibold">Create New Account</h2>

                <form method="post">
                    <div class="usernameBox">
                        <div class="inputBox">
                            <label>First Name</label>
                            <input type="text" name="firstName" required>
                        </div>
                        <div class="inputBox">
                            <label>Last Name</label>
                            <input type="text" name="lastName" require>
                        </div>
                    </div>
                    <div class="inputBox">
                        <label>Phone</label>
                        <input type="tel" name="phone" require>
                    </div>
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
                        <p>I accept SETRAM terms</p>
                    </div>
                    <input type="submit" class="btnSubmit">

                    <div class="alreadyExistBox">
                        <p>Already have an Account <a href="http://localhost:8000/login">?Login</a> </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="secondPart">

        </div>
    </section>
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
    if ($res !== 'User Already exists.') {
        $id = $res;
        $_SESSION['username'] = $id . "_" . $firstName . "_" . $lastName;
        header("Location: /dashboard/dashboard");
    } else {
        echo "User Already exists.";
    }
}
