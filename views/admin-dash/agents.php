<?php
require('./config/config.php');
require('./src/Models/Client.php');
require('./src/Models/Agent.php');


session_start();
session_regenerate_id();


if (!isset($_SESSION['username']))      // if there is no valid session
{
    header("Location: admin/login");
}


$parts = explode('_', $_SESSION['username']);
$id = $parts[0];

$agent = new Agent("", "", "", "", "");
$agentsDetails = $agent->getAllAgents($pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Agents</title>
</head>

<body class="bg-violet-100">
    <section class="flex ">
        <!-- side barre --->
        <div>
            <?php require('./views/component/SideBarAd.php'); ?>
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
                            <th class="py-2 px-4">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agentsDetails as $agentsDetails) : ?>
                            <tr class="hover:bg-blue-100 w-[600px]">
                                <td class="py-2 px-4"><?= $agentsDetails['FirstName'] ?></td>
                                <td class="py-2 px-4"><?= $agentsDetails['LastName'] ?></td>
                                <td class="py-2 px-4"><?= $agentsDetails['Email'] ?></td>
                                <td class="py-2 px-4"><?= $agentsDetails['Phone'] ?></td>

                                <td class="flex py-2 px-4">
                                    <button class="bg-green-500 text-white px-4 py-2 rounded mr-2" onclick="openUpdatePopup(
                        '<?= $agentsDetails['AgentID'] ?>',
                        '<?= $agentsDetails['FirstName'] ?>',
                        '<?= $agentsDetails['LastName'] ?>',
                        '<?= $agentsDetails['Email'] ?>',
                        '<?= $agentsDetails['Phone'] ?>',
                    )">Update</button>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="openDeletePopup('<?= $agentsDetails['AgentID'] ?>')">Delete</button>
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
                    <h2>Update Agent</h2>
                    <form class="flex flex-col gap-2 p-6" method="post" action="">
                        <input type="hidden" name="agentId" id="updateAgentId">
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateFirstName">First Name:</label>
                            <input class=" px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="text" name="firstName" id="updateFirstName" required>
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updateLastName">Last Name:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="text" name="lastName" id="updateLastName" required>
                        </div>


                        <div class="flex">
                            <label class="flex w-[150px]" for="updateEmail">Email:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="email" name="email" id="updateEmail">
                        </div>
                        <div class="flex">
                            <label class="flex w-[150px]" for="updatePhone">Phone:</label>
                            <input class="px-2 h-[30px] border rounded-[10px] border-black border-opacity-25" type="tel" name="phone" id="updatePhone">
                        </div>


                        <button class="my-6 btnSubmit" name="submit" type="submit">Update</button>
                    </form>
                </div>
            </div>

            <div id="deletePopup" class="deletePopup bg-white absolute right-[20%] left-[30%] w-[400px] top-[20%] shadow-md rounded" style="display: none;">
                <div class="popup-content flex flex-col items-center">
                    <span class="close flex justify-end w-full px-4 py-2 text-3xl cursor-pointer" onclick="closeDeletePopup()">&times;</span>
                    <h2>Delete Agent</h2>
                    <p>Are you sure you want to delete this agent?</p>
                    <form class="flex flex-col gap-2 p-6" method="post" action="">
                        <input type="hidden" name="deleteAgentId" id="deleteAgentId">
                        <button class="my-6 btnSubmit bg-red" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
</body>

</html>


<script>
    function openDeletePopup(agentId) {
        var popup = document.getElementById("deletePopup");
        popup.style.display = "block";
        document.getElementById("deleteAgentId").value = agentId;
    }

    function closeDeletePopup() {
        var popup = document.getElementById("deletePopup");
        document.getElementById("deleteAgentId").value = "";
        popup.style.display = "none";
    }

    function openUpdatePopup(agentId, firstName, lastName, email, phone) {
        var popup = document.getElementById("updatePopup");
        popup.style.display = "block";
        document.getElementById("updateAgentId").value = agentId;
        document.getElementById("updateFirstName").value = firstName;
        document.getElementById("updateLastName").value = lastName;
        document.getElementById("updateEmail").value = email;
        document.getElementById("updatePhone").value = phone;
    }

    function closeUpdatePopup() {
        var popup = document.getElementById("updatePopup");
        document.getElementById("updateAgentId").value = "";
        document.getElementById("updateFirstName").value = "";
        document.getElementById("updateLastName").value = "";
        document.getElementById("updateEmail").value = "";
        document.getElementById("updatePhone").value = "";
        popup.style.display = "none";

    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $agentDetails = $agent->getAgent($pdo, $_POST['agentId']);
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : $agentDetails['FirstName'];
        $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : $agentDetails['LastName'];
        $email = isset($_POST['email']) ? $_POST['email'] : $agentDetails['Email'];
        $phone = isset($_POST['phone']) ? $_POST['phone'] : $agentDetails['Phone'];

        $agent = new Agent($firstName, $lastName, $email, $phone, "");
        $success = $agent->updateAgent($pdo, $_POST['agentId']);

        if ($success) {
            echo "Updated";
        } else {
            // Update failed, handle error
            echo "Update failed.";
        }
    }


    if (isset($_POST['deleteAgentId'])) {
        // Delete logic
        $deleteAgentId = $_POST['deleteAgentId'];
        $success = $agent->deleteAgent($pdo, $deleteAgentId);

        if ($success) {
            echo "Deleted";
        } else {
            echo "Deletion failed.";
        }
    }
}
