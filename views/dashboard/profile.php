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
    <form method="post" name="profileForm" enctype="multipart/form-data">
        <div>
            <label for="">Firstname</label>
            <input type="text" name="firstName" value="<?php echo $clientData['FirstName']; ?>">
        </div>
        <div>
            <label for="">Lastname</label>
            <input type="text" name="lastName" value="<?php echo $clientData['LastName']; ?>">
        </div>
        <div>
            <label for="">Date Of Birth</label>
            <input type="date" name="dateOfBirth" value="<?php echo $clientData['DateOfBirth']; ?>">
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo $clientData['Email']; ?>">
        </div>
        <div>
            <label for="">Phone</label>
            <input type="phone" name="phone" value="<?php echo $clientData['Phone']; ?>">
        </div>
        <div>
            <label for="">Photo</label>
            <input type="file" name="avatar" value="<?php echo $clientData['Avatar']; ?>">
        </div>
        <div>
            <label for="">Gender</label>
            <input type="text" name="gender" value="<?php echo $clientData['Gender']; ?>">
        </div>
        <div>
            <label for=""></label>
            <input type="text" name="adresse" value="<?php echo $clientData['Adresse']; ?>">
        </div>
        <input type="submit" name="submit" value="Save">
    </form>
</body>

</html>

<?php
if (isset($_POST["submit"])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adresse = $_POST['adresse'];
    $gender = $_POST['gender'];
    $avatar = $_FILES['avatar'];

    if (isset($avatar["name"]) && !empty($avatar["name"])) {
        $clientDirectory = "./uploads/" . $id . "_" . $firstName . "_" . $lastName;
        if (!file_exists($clientDirectory)) {
            mkdir($clientDirectory, 0777, true);
        }
        $target_file = $clientDirectory . "/" . basename("avatar");

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (getimagesize($avatar["tmp_name"])) {
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            } else {
                if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
                    echo "The file " . basename($avatar["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
        }
    }
}





// $client = new Client($firstName || null, $lastName || null, $dateOfBirth || null, $email || null, $phone || null, null, $gender || null, $avatar || null, $adresse || null, null, null);
// $client->updateClient($pdo, $id);
