<?php


require('./src/Models/Subscription.php');
require('./src/Models/Client.php');
require('./src/Models/Document.php');
require('./src/Models/Card.php');
require('./config/config.php');

session_start();
session_regenerate_id();

if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: login");
}

$parts = explode('_', $_SESSION['username']);
$id = $parts[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
</head>


<body class="bg-violet-100">
    <section class="flex ">
        <div>
            <?php require('./views/component/SideBar.php'); ?>
        </div>
        <div class="px-20 py-10 flex flex-col gap-12 ml-[15%] w-[85%] ">
            <div>
                <span class="text-black text-opacity-60 text-[22px] font-normal">My Dashboard ></span>
                <span class="text-black text-[22px] font-normal">Subscription</span>
            </div>
            <form class="flex items-center gap-52" method="post" name="profileForm" enctype="multipart/form-data">
                <div class="flex flex-col gap-4">


                    <div class="flex gap-6 items-center">
                        <label class="w-[200px]" for="">The Full Address</label>
                        <div class="relative w-[300px] h-[35px]">
                            <input class="w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="adresse" placeholder="Example: 02 Rue Ahcene Khmissa">
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[200px]" for="">Category indicator</label>
                        <div class="flex w-[100px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="category" value="pupil">
                            <label>Pupil</label>
                        </div>
                        <div class="flex w-[100px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="category" value="student">
                            <label>Student</label>
                        </div>
                        <div class="flex w-[100px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="category" value="employee">
                            <label>Employee</label>
                        </div>
                    </div>

                    <div class="flex gap-6 items-center">
                        <label class="w-[200px]" for="">Subscription type</label>
                        <div class="flex w-[150px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="subType" value="Tram">
                            <label>Trameway</label>
                        </div>
                        <div class="flex w-[200px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="subType" value="Subway + Tram">
                            <label>Subway + Trameway</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="w-[100%] border-b-2 border-blue-900">
                            <h3 class="font-bold text-xl pb-2">Please file the documents below according to the declared information</h3>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[400px]" for="">Certificate of residence *</label>
                            <div class="flex">
                                <label for="certif_of_resid_upload" class="custom-file-upload">
                                    Upload
                                </label>
                                <input id="certif_of_resid_upload" class="px-2 border border-black border-opacity-25" type="file" name="certif_of_resid">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[400px]" for="">Study certificate ( for student)</label>
                            <div class="flex ">
                                <label for="certif_of_study_upload" class="custom-file-upload">
                                    Upload
                                </label>
                                <input id="certif_of_study_upload" class="px-2 border border-black border-opacity-25" type="file" name="certif_of_study">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[400px]" for="">Employment certificate (for employees)</label>
                            <div class="flex border">
                                <label for="certif_of_employe_upload" class="custom-file-upload">
                                    Upload
                                </label>
                                <input id="certif_of_employe_upload" class="px-2 border border-black border-opacity-25" type="file" name="certif_of_employe">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[400px]" for="">National card *</label>
                            <div class="flex">
                                <label for="national_card_upload" class="custom-file-upload">
                                    Upload
                                </label>
                                <input id="national_card_upload" class="px-2 border border-black border-opacity-25" type="file" name="national_card">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="w-[100%] border-b-2 border-blue-900">
                            <h3 class="font-bold text-xl pb-2">Payment Area</h3>
                        </div>

                        <div class="flex gap-6 items-center">
                            <label class="w-[200px]" for="">Card number</label>
                            <div class="relative w-[300px] h-[35px]">
                                <input class="w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="cardNumber" placeholder="Exemple: 6752-5682-8726-9038 ">
                            </div>
                        </div>
                        <div class="flex gap-6 items-center">
                            <label class="w-[200px]" for="">CVC2/CVV2 Code</label>
                            <div class="relative w-[300px] h-[35px]">
                                <input class="w-[300px] px-2 h-[35px] border bg-zinc-100 rounded-[10px] border-black border-opacity-25" type="text" name="cardNumber" placeholder="Exemple: 7635485 ">
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-6 items-center">
                        <label class="w-[200px]" for="">Plans</label>
                        <div class="flex w-[150px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="amount" value="200">
                            <label>Weekly 200DA</label>
                        </div>
                        <div class="flex w-[200px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="amount" value="600">
                            <label>Monthly 600DA</label>
                        </div>
                        <div class="flex w-[200px]">
                            <input class="px-2 border w-10 border-black border-opacity-25" type="radio" name="amount" value="6000">
                            <label>Yearly 6000DA</label>
                        </div>
                    </div>
                    <div class="w-[200px] mt-2">
                        <input class="btnSubmit" type="submit" name="submit" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>


<?php

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $adresse = $_POST['adresse'];
    $subType = $_POST['subType'];
    $certif_of_resid = $_FILES['certif_of_resid'];
    $certif_of_study = $_FILES['certif_of_study'];
    $certif_of_employe = $_FILES['certif_of_employe'];
    $national_card = $_FILES['national_card'];
    $amount = $_POST['amount'];
    $start_date = date("Y-m-d");
    $end_date = "";
    if ($amount == 200) {
        $wk = strtotime("+1 Week");
        $end_date = date('Y-m-d', $wk);
    } elseif ($amount == 600) {
        $month = strtotime("+1 Month");
        $end_date = date('Y-m-d', $month);
    } else {
        $year = strtotime("+1 Year");
        $end_date = date('Y-m-d', $year);
    }

    $subscription = new Subscription($subType, $start_date, null, $id, $end_date, $amount, $category, null);
    $res = $subscription->addSubscription($pdo);

    if ($res) {
        echo $res;
        $subID = $res;
        $status = "Not Approved";
        $card = new Card(rand(), $start_date, $end_date, $status, null, $id, $subID);
        $card->addCard($pdo);
        if (isset($_FILES["certif_of_resid"]) && !empty($certif_of_resid["name"])) {
            $clientDirectory = "./uploads/" . $id;
            if (!file_exists($clientDirectory)) {
                mkdir($clientDirectory, 0777, true);
            }
            $target_file = $clientDirectory . "/" . basename("certificate_of_residence") . ".pdf";
            $certif_of_resid_Target = $target_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "pdf") {
                echo "Sorry, only PDF files are allowed.";
            } else {
                if (file_exists($target_file)) {
                    echo "Sorry, the file already exists.";
                } else {
                    if (move_uploaded_file($_FILES["certif_of_resid"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["certif_of_resid"]["name"]) . " has been uploaded.";
                        $doc1 = new Document($id, "Certificate of residence",  $certif_of_resid_Target, date("Y-m-d h:i:sa"));
                        $doc1->addDocument($pdo);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        if (isset($_FILES["certif_of_study"]) && !empty($certif_of_study["name"])) {
            $clientDirectory = "./uploads/" . $id;
            if (!file_exists($clientDirectory)) {
                mkdir($clientDirectory, 0777, true);
            }
            $target_file = $clientDirectory . "/" . basename("certificate_of_study") . ".pdf";
            $certif_of_study_Target = $target_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "pdf") {
                echo "Sorry, only PDF files are allowed.";
            } else {
                if (file_exists($target_file)) {
                    echo "Sorry, the file already exists.";
                } else {
                    if (move_uploaded_file($_FILES["certif_of_study"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["certif_of_study"]["name"]) . " has been uploaded.";
                        $doc2 = new Document($id, "Certificate of study",  $certif_of_study_Target, date("Y-m-d h:i:sa"));
                        $doc2->addDocument($pdo);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
        if (isset($_FILES["certif_of_employe"]) && !empty($certif_of_employe["name"])) {
            $clientDirectory = "./uploads/" . $id;
            if (!file_exists($clientDirectory)) {
                mkdir($clientDirectory, 0777, true);
            }
            $target_file = $clientDirectory . "/" . basename("certificate_of_employe") . ".pdf";
            $certif_of_employe_Target = $target_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "pdf") {
                echo "Sorry, only PDF files are allowed.";
            } else {
                if (file_exists($target_file)) {
                    echo "Sorry, the file already exists.";
                } else {
                    if (move_uploaded_file($_FILES["certif_of_employe"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["certif_of_employe"]["name"]) . " has been uploaded.";
                        $doc3 = new Document($id, "Certificate of employe",  $certif_of_employe_Target, date("Y-m-d h:i:sa"));
                        $doc3->addDocument($pdo);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
        if (isset($_FILES["national_card"]) && !empty($national_card["name"])) {
            $clientDirectory = "./uploads/" . $id;
            if (!file_exists($clientDirectory)) {
                mkdir($clientDirectory, 0777, true);
            }
            $target_file = $clientDirectory . "/" . basename("national_card") . ".pdf";
            $national_card_Target = $target_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "pdf") {
                echo "Sorry, only PDF files are allowed.";
            } else {
                if (file_exists($target_file)) {
                    echo "Sorry, the file already exists.";
                } else {
                    if (move_uploaded_file($_FILES["national_card"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["national_card"]["name"]) . " has been uploaded.";
                        $doc4 = new Document($id, "national_card",  $national_card_Target, date("Y-m-d h:i:sa"));
                        $doc4->addDocument($pdo);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
}


?>