<?php
class Admin
{
    private $FirstName,
        $LastName,
        $Email,
        $Password;

    public function __construct($fn, $ln, $em, $psd)
    {
        $this->FirstName = $fn;
        $this->LastName = $ln;
        $this->Email = $em;
        $this->Password = $psd;
    }

    public function addAdmin($pdo)
    {
        try {
            $req = "INSERT INTO Administrators (FirstName, LastName, Email, Password) 
                    VALUES (:FirstName, :LastName, :Email, :Password)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':FirstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':LastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding Admin: " . $e->getMessage());
        }
    }
}
