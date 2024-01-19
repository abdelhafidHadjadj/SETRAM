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



$query = new QueryManager($pdo);
$reslt = $query->getVirtualCard($id);
if ($reslt) {
    $cardData = $reslt[0];
} else {
    $cardData = null;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Card</title>
</head>

<body class="bg-violet-100">
    <section class="flex ">
        <div>
            <?php require('./views/component/SideBar.php'); ?>
        </div>
        <div class="px-20 py-10 flex flex-col gap-12 ml-[15%] w-[85%] ">

            <div>
                <span class="text-black text-opacity-60 text-[22px] font-normal">My Profile ></span>
                <span class="text-black text-[22px] font-normal">My Card</span>
            </div>
            <?php
            if ($cardData && $cardData['Statut'] !== "Not Approved") {
                echo '<div class="text-xl">Your request is pending </div>';
            } else {
            ?>

                <div class="flex flex-col gap-4">
                    <div class="w-1/2 border-b-2 border-blue-900">
                        <h3 class="font-bold text-xl pb-2 text-blue-900">Virtual Card</h3>
                    </div>

                    <div class="card bg-white w-[400px] h-[200px] rounded-[33px] mb-2 relative shadow-md">
                        <div class="content p-4 flex flex-col items-start">
                            <img src="../../assets/logo-setram.png" alt="Company Logo" class="logo w-20 h-15 mx-auto">
                        </div>

                        <div class="flex items-center mb-8">
                            <!-- User information div -->
                            <div class="content p-4 text-center flex items-center">
                                <img src="../../assets/tramway-doran-730x430.png" alt="User Photo" class="user-photo w-20 h-20 rounded-full mb-2">
                                <div class="ml-4 flex flex-col items-start">
                                    <p class="text-sm mt-[-1px]">
                                        <span>First Name:</span>
                                        <span class="text-gray-500 ml-2">
                                            <?php
                                            if ($cardData) {

                                                echo $cardData['FirstName'];
                                            }

                                            ?></span>
                                    </p>
                                    <p class="text-sm mt-[-1px]">
                                        <span>Last Name:</span>
                                        <span class="text-gray-500 ml-2">
                                            <?php
                                            if ($cardData) {
                                                echo $cardData['LastName'];
                                            }

                                            ?></span>
                                    </p>
                                    <p class="text-sm mt-[-1px]">
                                        <span>Card Number:</span>
                                        <span class="text-gray-500 ml-2">
                                            <?php
                                            if ($cardData) {

                                                echo $cardData['CardNumber'];
                                            }

                                            ?></span>
                                    </p>
                                </div>
                            </div>

                            <!-- QR code div at the border of the card -->
                            <div class="ml-auto mt-4 mr-4 flex flex-col items-center">
                                <img src="../../assets/qrcode.png" alt="" class="w-10 h-10 mb-2">
                                <p class="text-xs">Valid Until 12/24</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-[50%] border-b-2 border-blue-900">
                        <h3 class="font-bold text-xl pb-2 text-blue-900">Declaration of loss</h3>
                    </div>
                    <form method="post" class=" flex flex-lign">
                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="flex gap-6 items-center">
                                <label class="w-[200px] text-blue-900" for="">Card Number</label>
                                <div class="relative w-[300px] h-[35px]">
                                    <input class="absolute px-2 h-[35px] w-[300px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="adresse" value="">
                                </div>
                            </div>
                        </div>
                        <div class="w-[222px] h-[56px] mt-2 ml-8">
                            <input class="btnSubmit" type="submit" name="submit" value="Save">
                        </div>
                    </form>
                </div>

            <?php
            }
            ?>

        </div>
    </section>
</body>

</html>