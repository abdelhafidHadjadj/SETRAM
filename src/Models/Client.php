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
            $stmt->bindParam(':AgentID', $this->AgentID, PDO::PARAM_STR);
            $stmt->bindParam(':AdminID', $this->AdminID, PDO::PARAM_STR);
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
                    SET FirstName = :firstName, LastName = :lastName, Email = :email, Phone = :phone, Password = :password, Gender = :gender, Avatar =:avatar, Adresse = :adresse, AgentID = :agentID, AdminID = :adminID 
                    WHERE ClientID = :clientID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':firstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $this->Phone, PDO::PARAM_STR);
            $stmt->bindParam(':password', $this->Password, PDO::PARAM_STR);
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
            if ($stmt) {
                return $stmt;
            }
        } catch (PDOException $e) {
            error_log('Error getting Client: ' . $e->getMessage());
        }
    }
}
