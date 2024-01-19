<?php



class AuthManager
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function registerClient($firstName, $lastName, $phone, $email, $password)
    {
        return $this->registerUser('Clients', $firstName, $lastName, $phone, $email, $password);
    }
    public function registerAgent($firstName, $lastName, $phone, $email, $password)
    {
        return $this->registerUser('Agents', $firstName, $lastName, $phone, $email, $password);
    }

    public function registerAdmin($firstName, $lastName, $phone, $email, $password)
    {
        return $this->registerUser('Administrators', $firstName, $lastName, $phone, $email, $password);
    }


    public function registerUser($table, $firstName, $lastName, $phone,  $email, $password)
    {
        $firstNameExist = $this->checkFirstNameExist($table, $firstName);
        $lastNameExist = $this->checkLastNameExist($table, $lastName);
        $emailExist = $this->checkEmailExist($table, $email);
        if ($emailExist || ($firstNameExist && $lastNameExist)) {
            return "User Already exists.";
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $req = "INSERT INTO $table (FirstName, LastName, Phone ,Email, Password) VALUES (:firstName,:lastName, :phone,:email,:password)";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $e = $stmt->execute();
        if ($e) {
            $lastInsertId = $this->pdo->lastInsertId();
            return $lastInsertId;
        } else {
            return "Registration failed.";
        }
    }

    private function checkEmailExist($table, $email)
    {
        $req = "SELECT COUNT(*) FROM $table WHERE Email = :email";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    private function checkFirstNameExist($table, $firstName)
    {
        $req = "SELECT COUNT(*) FROM $table WHERE FirstName = :firstName";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    private function checkLastNameExist($table, $lastName)
    {
        $req = "SELECT COUNT(*) FROM $table WHERE LastName = :lastName";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    public function loginUser($table, $email, $password)
    {
        $userExists = $this->checkLoginCredentials($table, $email, $password);

        if ($userExists) {
            return $userExists;
        } else {
            return "Invalid login credentials.";
        }
    }

    private function checkLoginCredentials($table, $email, $password)
    {
        $id = "";
        if ($table == "Clients") {
            $id = "ClientID";
        } elseif ($table == "Administrators") {
            $id = "AdminID";
        } else {
            $id = "AgentID";
        }
        $req = "SELECT FirstName, LastName, $id FROM $table WHERE Email = :email";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $e = $stmt->execute();
        $hashedPassword = $this->getHashedPassword($table, $email);


        if ($e && password_verify($password, $hashedPassword)) {

            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userDetails;
        } else {

            return false; // Invalid login credentials
        }
    }



    private function getHashedPassword($table, $email)
    {
        $query = "SELECT Password FROM $table WHERE Email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $email);

        $res = $statement->execute();

        // Fetch the column only once

        if ($res) {
            echo "Query executed successfully.<br>";
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $hashedPassword = $result['Password'];
                echo "Fetched Password: " . $hashedPassword . "<br>";
                return $hashedPassword;
            } else {
                echo "No results found for the email: $email.<br>";
                return false;
            }
        } else {
            echo "Error executing query.<br>";
            print_r($statement->errorInfo());
            return false;
        }
    }
}
