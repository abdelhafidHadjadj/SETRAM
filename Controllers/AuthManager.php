<?php



class AuthManager
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function registerClient($firstName, $lastName, $email, $password)
    {
        return $this->registerUser('Clients', $firstName, $lastName, $email, $password);
    }
    public function registerAgent($firstName, $lastName, $email, $password)
    {
        return $this->registerUser('Agents', $firstName, $lastName, $email, $password);
    }
    public function registerUser($table, $firstName, $lastName, $email, $password)
    {
        $firstNameExist = $this->checkFirstNameExist($table, $firstName);
        $lastNameExist = $this->checkLastNameExist($table, $lastName);
        $emailExist = $this->checkEmailExist($table, $email);
        if ($emailExist || ($firstNameExist && $lastNameExist)) {
            return "User Already exists.";
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $req = "INSERT INTO $table (FirstName, LastName, Email, Password) VALUES (:firstName,:lastName,:email,:password)";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $e = $stmt->execute();
        if ($e) {
            return "Registration successful.";
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
            return "Login successful.";
        } else {
            return "Invalid login credentials.";
        }
    }

    private function checkLoginCredentials($table, $email, $password)
    {
        $req = "SELECT COUNT(*) FROM $table WHERE email = :email AND password = :password";

        $stmt = $this->pdo->prepare($req);
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $e = $stmt->execute();
        $hashedPassword = $this->getHashedPassword($table, $email);
        return password_verify($password, $hashedPassword) && $this->checkExistence($req, $email, $hashedPassword);
    }

    private function checkExistence($req, ...$params)
    {
        $statement = $this->pdo->prepare($req);
        foreach ($params as $key => $value) {
            $paramName = ":param{$key}";
            $statement->bindParam($paramName, $value);
        }

        $statement->execute();
        $count = $statement->fetchColumn();

        return $count > 0;
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
