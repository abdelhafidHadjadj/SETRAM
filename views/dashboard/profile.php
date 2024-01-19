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

<body class="bg-violet-100">
    <section class="flex ">
        <div>
            <?php require('./views/component/SideBar.php'); ?>
        </div>
        <div class="px-20 py-10 flex flex-col gap-12 ml-[15%] w-[85%] ">
            <div>
                <span class="text-black text-opacity-60 text-[22px] font-normal">My Profile ></span>
                <span class="text-black text-[22px] font-normal">Edit Profile</span>
            </div>
            <form class="flex items-center gap-52" method="post" name="profileForm" enctype="multipart/form-data">
                <div class="flex flex-col gap-4">

                    <div class="flex gap-10">
                        <div class="flex flex-col ">
                            <label class="w-[120px]" for="">Firstname</label>
                            <input class="w-[250px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="firstName" value="<?php echo $clientData['FirstName']; ?>">
                        </div>
                        <div class="flex flex-col ">
                            <label class="w-[120px]" for="">Lastname</label>
                            <input class="w-[250px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="lastName" value="<?php echo $clientData['LastName']; ?>">
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[120px]" for="">Gender</label>
                        <input type="hidden" id="selectedGender" name="selectedGender" value="<?php echo $clientData['Gender']; ?>">
                        <div class="flex gap-6">
                            <div class="flex items-center gap-2" onclick="selectGender('male')">
                                <span class="flex items-center justify-center border rounded-full w-8 h-8 
                                <?php
                                if ($clientData['Gender'] === 'male') {
                                    echo "bg-[#164C8D]";
                                }
                                ?>"><?php require('./assets/male.svg') ?></span>
                                Male
                            </div>
                            <div class="flex items-center gap-2" onclick="selectGender('female')">
                                <span class="flex items-center justify-center border rounded-full w-8 h-8
                                <?php
                                if ($clientData['Gender'] === 'female') {
                                    echo "bg-[#164C8D]";
                                }
                                ?>
                                "><?php require('./assets/female.svg') ?></span>
                                Female
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[120px]" for="">Date Of Birth</label>
                        <div class="relative w-[300px] h-[35px]">
                            <input class="absolute w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25 " type="date" name="dateOfBirth" placeholder="DD/MM/YYYY" value="<?php echo $clientData['DateOfBirth']; ?>">
                            <span class="absolute right-[5%] top-[15%] h-full">
                                <?php require('./assets/calendar.svg') ?>
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[120px]" for="">Email</label>
                        <div class="relative w-[300px] h-[35px]">
                            <input class="absolute  w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="email" name="email" value="<?php echo $clientData['Email']; ?>">
                            <span class="absolute right-[5%] top-[25%] h-full">
                                <?php require('./assets/mail.svg') ?>
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[120px]" for="">Phone</label>
                        <div class="relative w-[300px] h-[35px]">

                            <input class="absolute  w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="phone" name="phone" value="<?php echo $clientData['Phone']; ?>">
                            <span class="absolute right-[5%] top-[15%] h-full">
                                <?php require('./assets/phone.svg') ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-6 items-center">
                        <label class="w-[120px]" for="">Address</label>
                        <div class="relative w-[300px] h-[35px]">
                            <input class="absolute px-2 h-[35px] w-[300px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25 " type="text" name="adresse" value="<?php echo $clientData['Adresse']; ?>">
                        </div>
                    </div>
                    <div class="w-[200px] mt-2">
                        <input class="btnSubmit" type="submit" name="submit" value="Save">
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="border-2 w-[150px] h-[150px] rounded-full">

                        <img width="100" class="rounded-full border-2 w-[150px] h-[150px]" src="<?php echo $URL . ltrim($clientData['Avatar'], $clientData['Avatar'][0]); ?>" alt="">

                    </div>
                    <label for="file-upload" class="mt-4 custom-file-upload">
                        Upload Photo
                    </label>
                    <input id="file-upload" class="px-2 border border-black border-opacity-25" type="file" name="avatar">
                </div>
            </form>
            <div class="flex flex-col gap-4">
                <div class="w-[50%] border-b-2 border-blue-900">
                    <h3 class="font-bold text-xl pb-2">Change Password</h3>
                </div>
                <form method="post" class="flex gap-20 items-end">
                    <div class="flex flex-col gap-2">

                        <div class="flex gap-6 items-center">
                            <label class="w-[200px]" for="">Current Password</label>
                            <div class="relative w-[300px] h-[35px]">
                                <input class="absolute px-2 h-[35px] w-[300px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25 " type="text" name="adresse" value="">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[200px]" for="">New Password</label>
                            <div class="relative w-[300px] h-[35px]">
                                <input class="absolute px-2 h-[35px] w-[300px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25 " type="text" name="adresse" value="">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[200px]" for="">Confirm Password</label>
                            <div class="relative w-[300px] h-[35px]">
                                <input class="absolute px-2 h-[35px] w-[300px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25 " type="text" name="adresse" value="">
                            </div>
                        </div>
                    </div>
                    <div class="w-[200px] mt-2">
                        <input class="btnSubmit" type="submit" name="submit" value="Save">
                    </div>
                </form>
            </div>

        </div>
    </section>
</body>

</html>

<script>
    function selectGender(gender) {
        document.getElementById('selectedGender').value = gender;
        console.log(gender);
    }
</script>


<?php
if (isset($_POST["submit"])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adresse = $_POST['adresse'];
    $gender = $_POST['selectedGender'];
    $avatar = $_FILES['avatar'];
    $avatarTarget = "";
    $uploadSuccess = false;
    if (isset($avatar["name"]) && !empty($avatar["name"])) {
        $clientDirectory = "./uploads/" . $id;
        if (!file_exists($clientDirectory)) {
            mkdir($clientDirectory, 0777, true);
        }
        $target_file = $clientDirectory . "/" . basename("avatar") . ".png";
        $avatarTarget = $target_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (getimagesize($avatar["tmp_name"])) {
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            } else {
                if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
                    echo "The file " . basename($avatar["name"]) . " has been uploaded.";
                    $uploadSuccess = true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
        }
    }

    $client = new Client($firstName, $lastName, $dateOfBirth, $email, $phone, null, $gender, $avatarTarget, $adresse, null, null);
    $client->updateClient($pdo, $id);
    header("Location: profile.php");
}
