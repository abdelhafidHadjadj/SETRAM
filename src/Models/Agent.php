<?php
class Agent
{
    private $FirstName,
        $LastName,
        $DateOfBirth,
        $Email,
        $Password;


    public function __construct($fn, $ln, $dob, $em, $psd)
    {
        $this->FirstName = $fn;
        $this->LastName = $ln;
        $this->DateOfBirth = $dob;
        $this->Email = $em;
        $this->Password = $psd;
    }

    public function addAgent($pdo)
    {
        try {
            $req = "INSERT INTO Agents (FirstName, LastName, DateOfBirth, Email, Password) 
                    VALUES (:FirstName, :LastName, :DateOfBirth, :Email, :Password)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':FirstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':LastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':DateOfBirth', $this->DateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding agent: " . $e->getMessage());
        }
    }

    public function updateAgent($pdo, $agentID)
    {
        try {
            $req = "UPDATE Agents
                    SET FirstName = :firstName, LastName = :lastName, DateOfBirth = :dateOfBirth, Email = :email, Password = :password 
                    WHERE AgentID = :agentID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':firstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':dateOfBirth', $this->DateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $this->Password, PDO::PARAM_STR);
            $stmt->bindParam(':agentID', $agentID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating agent: ' . $e->getMessage());
        }
    }

    public function deleteAgent($pdo, $agentID)
    {
        try {
            $req = "DELETE FROM Agents WHERE AgentID = :agentID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':agentID', $agentID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting Agent: ' . $e->getMessage());
        }
    }
}
