<?php
class Agent
{
    private $FirstName,
        $LastName,
        $Phone,
        $Email,
        $Password;


    public function __construct($fn, $ln, $ph, $em, $psd)
    {
        $this->FirstName = $fn;
        $this->LastName = $ln;
        $this->Phone = $ph;
        $this->Email = $em;
        $this->Password = $psd;
    }

    public function addAgent($pdo)
    {
        try {
            $req = "INSERT INTO Agents (FirstName, LastName, Phone, Email, Password) 
                    VALUES (:FirstName, :LastName, :Phone, :Email, :Password)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':FirstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':LastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':Phone', $this->Phone, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding agent: " . $e->getMessage());
        }
    }

    public function getAgent($pdo, $agnetId)
    {
        try {
            $req = "SELECT * FROM Agents WHERE agentId = :agentId";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':agentId', $agnetId, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die("Error getting agent: " . $e->getMessage());
        }
    }

    public function updateAgent($pdo, $agentID)
    {
        try {
            $req = "UPDATE Agents
                    SET FirstName = :firstName, LastName = :lastName, Phone = :phone, Email = :email, Password = :password 
                    WHERE AgentID = :agentID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':firstName', $this->FirstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $this->LastName, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $this->Phone, PDO::PARAM_STR);
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


    public function getNbrAgents($pdo)
    {
        try {
            $req = "SELECT COUNT(*) as AgentCount FROM Agents";
            $stmt = $pdo->prepare($req);
            $stmt->execute();
            $res =  $stmt->fetch(PDO::FETCH_ASSOC);
            if ($res !== false) {
                return $res['AgentCount'];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error getting Nbr Agents: ' . $e->getMessage());
        }
    }

    public function getAllAgents($pdo)
    {
        try {
            $req = "SELECT * FROM Agents";
            $stmt = $pdo->prepare($req);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error getting All Agents: ' . $e->getMessage());
        }
    }
}
