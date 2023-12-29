<?php
class Client
{
    private $FirstName,
        $LastName,
        $DateOfBirth,
        $Email,
        $Phone,
        $Password,
        $Gender,
        $Category,
        $Adresse;


    public function __construct($Fn, $Ln, $Dob, $Em, $Ph, $Ps, $Gnd, $Cat, $adrs)
    {
        $this->FirstName = $Fn;
        $this->LastName = $Ln;
        $this->DateOfBirth = $Dob;
        $this->Email = $Em;
        $this->Phone = $Ph;
        $this->Password = $Ps;
        $this->Gender = $Gnd;
        $this->Category = $Cat;
        $this->Adresse = $adrs;
    }

    public function addClient($pdo)
    {
        try {
            $req = "INSERT INTO Clients (FirstName, LastName, DateOfBirth, Email, Phone ,Password, Gender, Category, Adresse) 
                    VALUES (:FirstName, :LastName, :DateOfBirth, :Email, Phone,:Password, :Gender, :Category, :Adresse)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':FirstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':LastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':DateOfBirth', $this->DateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':Phone', $this->Phone, PDO::PARAM_INT);
            $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
            $stmt->bindParam(':Gender', $this->Gender, PDO::PARAM_STR);
            $stmt->bindParam(':Category', $this->Category, PDO::PARAM_STR);
            $stmt->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding course: " . $e->getMessage());
        }
    }

    public function updateClient($pdo, $clientID)
    {
        try {
            $req = "UPDATE Clients
                    SET FirstName = :firstName, LastName = :lastName, Email = :email, Phone = :phone, Password = :password, Gender = :gender, Category = :category, Adresse = :adresse 
                    WHERE ClientID = :clientID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':firstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $this->Phone, PDO::PARAM_STR);
            $stmt->bindParam(':password', $this->Password, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $this->Gender, PDO::PARAM_STR);
            $stmt->bindParam(':category', $this->Category, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $this->Adresse, PDO::PARAM_STR);
            $stmt->bindParam(':clientID', $clientID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating client: ' . $e->getMessage());
        }
    }

    public function deleteClient($pdo, $clientID)
    {
        try {
            $req = "DELETE FROM Clients WHERE ClientID = :clientID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':clientID', $clientID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting Subscription: ' . $e->getMessage());
        }
    }
}
