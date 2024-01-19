<?php

require('./Controllers/AuthManager.php');
require('./config/config.php');

// $auth = new AuthManager($pdo);
// $res =  $auth->registerAgent("agent1", "agent1", 046543, "agent@1", "agent1");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/styleAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>login</title>
</head>

<body>
    <div class="firstPart">
        <div class="logoBox">
            <img src="../../assets/logo-setram.png" alt="">
        </div>
        <div class="formBox">
            <h2>Welcome Agent !</h2>
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
                    <p>Remeber me </p>
                </div>
                <input type="submit" class="btnSubmit">
            </form>
        </div>
    </div>

</body>


</html>

<?php



if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $login = new AuthManager($pdo);


    $res = $login->loginUser('Agents', $email, $password);

    var_dump($res);
    if ($res) {
        $id = $res['AgentID'];
        $firstName = $res['FirstName'];
        $lastName = $res['LastName'];
        $_SESSION['username'] = $id . "_" . $firstName . "_" . $lastName;
        header("Location: /agent/profile");
    }
}
