<?php
require('./config/config.php');
require('./src/Models/Client.php');
require('./src/Models/Agent.php');

$query = new QueryManager($pdo);
$nbrStudents = $query->getStudentsCount();
$nbrEmployee = $query->getEmployeeCount();
$nbrPupils = $query->getPupilsCount();

$agents = new Agent("", "", "", "", "");
$nbrAgents = $agents->getNbrAgents($pdo);


session_start();
session_regenerate_id();


if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: admin/login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Admin</title>
</head>

<body class="bg-violet-100">
    <section class="flex ">
        <div>
            <?php require('./views/component/SideBarAd.php'); ?>
        </div>
        <div class="px-20 py-8 flex flex-col gap-12 ml-[15%] w-[85%] ">
            <!--- My profil > MY card ---->
            <div>
                <span class="text-black text-opacity-60 text-[22px] font-normal">My Profile ></span>
                <span class="text-black text-[22px] font-normal">Home</span>
            </div>
            <div class="flex justify-between">

                <div class="flex flex-col gap-4">
                    <div class="w-[600px] border-b-2 border-blue-900">
                        <h3 class="font-bold text-xl  text-blue-900">Total Subscription</h3>
                    </div>
                    <div class="card bg-white w-[600px] h-[100px] rounded-[10px] mb-1 relative">
                        <div class="sub-div flex flex-col bg-blue-800 w-1/4 h-full rounded-l-[10px]  float-left flex items-center justify-center">
                            <p class="text-white">Pupils</p>
                            <span class="text-white font-semibold text-4xl"><?php echo $nbrPupils; ?></span>
                        </div>
                        <div class="sub-div flex flex-col bg-blue-800 w-1/4 h-full float-left flex items-center justify-center">
                            <p class="text-white">Students</p>
                            <span class="text-white font-semibold text-4xl"><?php echo $nbrStudents; ?></span>
                        </div>
                        <div class="sub-div flex flex-col bg-blue-800 w-1/4 h-full float-left flex items-center justify-center">
                            <p class="text-white">Employees</p>
                            <span class="text-white font-semibold text-4xl"><?php echo $nbrEmployee; ?></span>
                        </div>
                        <div class="sub-div flex flex-col bg-blue-800 w-1/4 h-full rounded-r-[10  px] float-left flex items-center justify-center">
                            <p class="text-white">Agents</p>
                            <span class="text-white font-semibold text-4xl"><?php echo $nbrAgents; ?></span>
                        </div>
                    </div>
                    <div class="w-[600px] border-b-2 border-blue-900">
                        <h3 class="font-bold text-xl  text-blue-900">Lign Chart</h3>
                    </div>
                    <div class="card bg-white w-[600px] h-[250px] rounded-[10px] mb-1 relative">
                        <img src="../../assets/ligne-chart.png" alt="">
                    </div>



                </div>

                <!-- <div class="flex flex-col gap-4 mb-2">
                    </div> -->
                <div class="flex flex-col">

                    <div class="flex flex-col gap-4 mb-2">
                        <div class="w-[450px] border-b-2 border-blue-900 ">
                            <h3 class="font-bold text-xl  text-blue-900 ">Bar Chart</h3>
                        </div>
                        <div class="card bg-white w-[450px] h-[200px] rounded-[10px] mb-2 relative">
                            <img src="../../assets/bar-chart.png" class="w-[450px] h-[200px]" alt="">
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 mb-2">
                        <div class="w-[450px] border-b-2 border-blue-900">
                            <h3 class="font-bold text-xl  text-blue-900">Pie Chart</h3>
                        </div>
                        <div class="card bg-white w-[450px] h-[200px] rounded-[10px] mb-2 relative">
                            <img src="../../assets/pie-chart.png" class="w-[450px] h-[200px]" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</body>

</html>