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
        $req = "SELECT FirstName, LastName, ClientID FROM $table WHERE Email = :email";

        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $hashedPassword = $this->getHashedPassword($table, $email);
        $e = $stmt->execute();


        if ($e && password_verify($password, $hashedPassword)) {
            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userDetails;
        } else {
            return false; // Invalid login credentials
        }
    }



    private function getHashedPassword($table, $email)
    {
        $query = "SELECT password FROM $table WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return $statement->fetchColumn();
    }
}
