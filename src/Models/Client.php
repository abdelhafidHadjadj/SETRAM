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
        $Avatar,
        $Adresse,
        $AgentID,
        $AdminID;


    public function __construct($Fn, $Ln, $Dob, $Em, $Ph, $Ps, $Gnd, $avat, $adrs, $agID, $adID)
    {
        $this->FirstName = $Fn;
        $this->LastName = $Ln;
        $this->DateOfBirth = $Dob;
        $this->Email = $Em;
        $this->Phone = $Ph;
        $this->Password = $Ps;
        $this->Gender = $Gnd;
        $this->Avatar = $avat;
        $this->Adresse = $adrs;
        $this->AgentID = $agID;
        $this->AdminID = $adID;
    }

    public function addClient($pdo)
    {
        try {
            $req = "INSERT INTO Clients (FirstName, LastName, DateOfBirth, Email, Phone ,Password, Gender, Avatar, Adresse , AgnetID, AdminID) 
                    VALUES (:FirstName, :LastName, :DateOfBirth, :Email, Phone,:Password, :Gender, :Avatar, :Adresse, :AgnetID, :AdminID)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':FirstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':LastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':DateOfBirth', $this->DateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':Phone', $this->Phone, PDO::PARAM_INT);
            $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
            $stmt->bindParam(':Gender', $this->Gender, PDO::PARAM_STR);
            $stmt->bindParam(':Avatar', $this->Avatar, PDO::PARAM_STR);
            $stmt->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
            $stmt->bindParam(':AgentID', $this->AgentID, PDO::PARAM_INT);
            $stmt->bindParam(':AdminID', $this->AdminID, PDO::PARAM_INT);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding client: " . $e->getMessage());
        }
    }

    public function updateClient($pdo, $clientID)
    {
        try {
            $req = "UPDATE Clients
                    SET FirstName = :firstName, LastName = :lastName, DateOfBirth = :dateOfBirth, Email = :email, Phone = :phone, Gender = :gender, Avatar = :avatar, Adresse = :adresse, AgentID = :agentID, AdminID = :adminID 
                    WHERE ClientID = :clientID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':firstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':dateOfBirth', $this->DateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $this->Phone, PDO::PARAM_INT);
            $stmt->bindParam(':gender', $this->Gender, PDO::PARAM_STR);
            $stmt->bindParam(':avatar', $this->Avatar, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $this->Adresse, PDO::PARAM_STR);
            $stmt->bindParam(':agentID', $this->AgentID, PDO::PARAM_STR);
            $stmt->bindParam(':adminID', $this->AdminID, PDO::PARAM_STR);
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
            error_log('Error deleting Client: ' . $e->getMessage());
        }
    }
    public function getClient($pdo, $id)
    {
        try {
            $req = "SELECT * FROM Clients WHERE ClientID = :clientID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':clientID', $id, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error getting Client: ' . $e->getMessage());
        }
    }
    public function getAllClient($pdo)
    {
        try {
            $req = "SELECT * FROM Clients";
            $stmt = $pdo->prepare($req);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error getting All Client: ' . $e->getMessage());
        }
    }
}
