<?php
session_start();
session_regenerate_id();

require('./config/config.php');
require_once('./Controllers/QueryManager.php');


if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: /login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];

// hna nb3t request to db bch n recuperer data t3 user


$getSub = new QueryManager($pdo);
$res = $getSub->getSubscriptionByClient($id);
if ($res) {
    $data = $res;
} else {
    $data = null;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
</head>

<body class="bg-violet-100">
    <section class="flex">
        <div>
            <?php require('./views/component/SideBar.php'); ?>
        </div>
        <div class="px-20 py-10 flex flex-col gap-12 ml-[15%] w-[85%] h-full">
            <div class="shadow-md border w-full h-[200px] rounded-xl flex items-center justify-center">
                <h1 class="text-2xl font-bold">Welcome <?php echo $parts[1] . " " . $parts[2] . " !"; ?></h1>
            </div>
            <div class="flex w-full justify-between h-[400px]">
                <div class="border rounded-xl w-[48%] shadow-md p-10 flex flex-col">
                    <h1 class="text-2xl font-bold">Notifications</h1>
                    <p>Not available</p>
                </div>
                <div class="border rounded-xl w-[48%] gap-2 shadow-md p-10 flex flex-col items-center">

                    <?php
                    if (!$data) {
                        echo "<div><p>You don't have any subscription</p>
                        </div>";
                    } else {
                    ?>

                        <h1 class="text-2xl font-bold">
                            Subscription Details
                        </h1>
                        <div>
                            <p class="text-xl">
                                Start Date: <span>
                                    <?php
                                    if ($data) {

                                        echo end($data)['Start_Date'];
                                    }
                                    ?>
                                </span></p>
                            <p class="text-xl">End Date: <span>
                                    <?php
                                    if ($data) {

                                        echo end($data)['End_Date'];
                                    }
                                    ?>

                                </span></p>
                            <p class="text-xl">Plan: <span>
                                    <?php
                                    if ($data) {

                                        echo end($data)['Plan'];
                                    }

                                    ?></span></p>
                            <p class="text-xl">Amount: <span>
                                    <?php
                                    if ($data) {
                                        echo end($data)['Amount'];
                                    }

                                    ?></span></p>
                        </div>
                    <?php  } ?>
                </div>
            </div>


        </div>
    </section>
</body>



</html>