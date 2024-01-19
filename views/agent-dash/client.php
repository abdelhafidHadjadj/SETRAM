<?php
require('./config/config.php');
require('./src/Models/Client.php');

$client = new Client("", "", "", "", "", "", "", "", "", "", "");
$clientsDetails = $client->getAllClient($pdo);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Clients</title>
</head>

<body class="bg-violet-100">
    <section class="flex ">
        <!-- side barre --->
        <div>
            <?php require('./views/component/SideBarAg.php'); ?>
        </div>

        <div class="px-20 py-10 flex flex-col gap-12 ml-[15%] w-[85%] ">
            <!--- My profil > MY card ---->
            <div>
                <span class="text-black text-opacity-60 text-[22px] font-normal">My Profile ></span>
                <span class="text-black text-[22px] font-normal">Client</span>
            </div>

            <div class="flex flex-col gap-4">
                <div class="w-[1100px] border-b-2 border-blue-900">
                    <h3 class="font-bold text-xl  text-blue-900">All Clients</h3>
                </div>
            </div>
            <!-- Barre de recherche -->
            <div class="flex mb-4">
                <input type="text" placeholder="Search..." class="p-2 border border-gray-300 rounded-l w-[1000px] focus:outline-none">
                <button class="bg-blue-900 text-white p-2 rounded-r">Search</button>
            </div>
            <!-- Tableau avec boutons d'action -->
            <div class="bg-white w-[1100px]  shadow-md rounded-lg ">
                <table class="w-full border-collapse w-[600px]">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="py-2 px-4">First Name</th>
                            <th class="py-2 px-4">Last Name</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Gender</th>
                            <th class="py-2 px-4">Date of Birth</th>
                            <th class="py-2 px-4">Phone</th>
                            <th class="py-2 px-4">Home Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientsDetails as $clientDetails) : ?>
                            <tr class="hover:bg-blue-100 w-[600px]">
                                <td class="py-2 px-4"><?= $clientDetails['FirstName'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['LastName'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['Email'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['Gender'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['DateOfBirth'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['Phone'] ?></td>
                                <td class="py-2 px-4"><?= $clientDetails['Adresse'] ?></td>
                                <td class="flex py-2 px-4">
                                    <button class="bg-green-500 text-white px-4 py-2 rounded mr-2" onclick="openUpdatePopup(
                        '<?= $clientDetails['ClientID'] ?>',
                        '<?= $clientDetails['FirstName'] ?>',
                        '<?= $clientDetails['LastName'] ?>',
                        '<?= $clientDetails['Gender'] ?>',
                        '<?= $clientDetails['DateOfBirth'] ?>',
                        '<?= $clientDetails['Email'] ?>',
                        '<?= $clientDetails['Phone'] ?>',
                        '<?= $clientDetails['Adresse'] ?>'
                    )">Update</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="openDeletePopup('<?= $clientDetails['ClientID'] ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
            <div id="updatePopup" class="hidden popup bg-white absolute right-[20%] left-[30%] w-[600px] top-[20%] shadow-md rounded">
                <div class="popup-content flex flex-col items-center">
                    <div class="flex justify-end w-full px-4 py-2">
                        <span class="close   text-3xl cursor-pointer" onclick="closeUpdatePopup()">&times;</span>
                    </div>
                    <h2>Update Client</h2>
                    <form class="flex flex-col gap-2 p-6" method="post" action="">
                        <input type="hidden" name="clientId" id="updateClientId">
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateFirstName">First Name:</label>
                            <input class=" px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="text" name="firstName" id="updateFirstName" required>
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateLastName">Last Name:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="text" name="lastName" id="updateLastName" required>
                        </div>
                        <div class="flex gap-6">


                            <label class="flex w-[100px]" for="updateGender">Gender:</label>
                            <div class="flex gap-2">

                                <div class="flex w-[100px]">
                                    <input class="gender-radio px-2 border w-10 border-black border-opacity-25" type="radio" name="gender" value="male">
                                    <label>Male</label>
                                </div>
                                <div class="flex w-[100px]">
                                    <input class="gender-radio px-2 border w-10 border-black border-opacity-25" type="radio" name="gender" value="female">
                                    <label>Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateDateOfBirth">Date Of Birth:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="date" name="dateOfBirth" id="updateDateOfBirth">
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateEmail">Email:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="email" name="email" id="updateEmail">
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updatePhone">Phone:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="tel" name="phone" id="updatePhone">
                        </div>

                        <div class="flex">
                            <label class="flex w-[150px]" for="updateHomeAddress">Home Address:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="text" name="homeAddress" id="updateHomeAddress">
                        </div>

                        <button class="my-6 btnSubmit" name="submit" type="submit">Update</button>
                    </form>
                </div>
            </div>

            <div id="deletePopup" class="deletePopup bg-white absolute right-[20%] left-[30%] w-[400px] top-[20%] shadow-md rounded" style="display: none;">
                <div class="popup-content flex flex-col items-center">
                    <span class="close flex justify-end w-full px-4 py-2 text-3xl cursor-pointer" onclick="closeDeletePopup()">&times;</span>
                    <h2>Delete Client</h2>
                    <p>Are you sure you want to delete this client?</p>
                    <form class="flex flex-col gap-2 p-6" method="post" action="">
                        <input type="hidden" name="deleteClientId" id="deleteClientId">
                        <button class="my-6 btnSubmit bg-red" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
</body>

</html>


<script>
    function openDeletePopup(clientId) {
        var popup = document.getElementById("deletePopup");
        popup.style.display = "block";
        document.getElementById("deleteClientId").value = clientId;
    }

    function closeDeletePopup() {
        var popup = document.getElementById("deletePopup");
        document.getElementById("deleteClientId").value = "";
        popup.style.display = "none";
    }

    function openUpdatePopup(clientId, firstName, lastName, gender, dateOfBirth, email, phone, homeAddress) {
        var popup = document.getElementById("updatePopup");
        popup.style.display = "block";


        document.getElementById("updateClientId").value = clientId;
        document.getElementById("updateFirstName").value = firstName;
        document.getElementById("updateLastName").value = lastName;
        var selectedGenderRadioButton = document.querySelector('.gender-radio[value="' + gender + '"]');
        if (selectedGenderRadioButton) {
            selectedGenderRadioButton.checked = true;
        }
        document.getElementById("updateDateOfBirth").value = dateOfBirth;
        document.getElementById("updateEmail").value = email;
        document.getElementById("updatePhone").value = phone;
        document.getElementById("updateHomeAddress").value = homeAddress;
    }

    function closeUpdatePopup() {
        var popup = document.getElementById("updatePopup");
        document.getElementById("updateClientId").value = "";
        document.getElementById("updateFirstName").value = "";
        document.getElementById("updateLastName").value = "";
        var genderRadioButtons = document.querySelectorAll('input[name="gender"]');
        genderRadioButtons.forEach(function(radio) {
            radio.checked = false;
        });
        document.getElementById("updateDateOfBirth").value = "";
        document.getElementById("updateEmail").value = "";
        document.getElementById("updatePhone").value = "";
        document.getElementById("updateHomeAddress").value = "";
        popup.style.display = "none";

    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        // Update logic
        $clientDetails = $client->getClient($pdo, $_POST['clientId']);
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : $clientDetails['FirstName'];
        $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : $clientDetails['LastName'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : $clientDetails['Gender'];
        $dateOfBirth = isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth'] : $clientDetails['DateOfBirth'];
        $email = isset($_POST['email']) ? $_POST['email'] : $clientDetails['Email'];
        $phone = isset($_POST['phone']) ? $_POST['phone'] : $clientDetails['Phone'];
        $homeAddress = isset($_POST['homeAddress']) ? $_POST['homeAddress'] : $clientDetails['Adresse'];

        $client = new Client($firstName, $lastName, $dateOfBirth, $email, $phone, null, $gender, null, $homeAddress, null, null);
        $success = $client->updateClient($pdo, $_POST['clientId']);

        if ($success) {
            // Update successful, redirect or show a success message
            echo "Updated";
        } else {
            // Update failed, handle error
            echo "Update failed.";
        }
    }


    if (isset($_POST['deleteClientId'])) {
        // Delete logic
        $deleteClientId = $_POST['deleteClientId'];
        $success = $client->deleteClient($pdo, $deleteClientId);

        if ($success) {
            echo "Deleted";
        } else {
            echo "Deletion failed.";
        }
    }
}
