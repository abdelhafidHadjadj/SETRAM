<?php
class Card
{
    private $CardNumber,
        $Start_Date,
        $End_Date,
        $Statut,
        $AgentID,
        $ClientID,
        $SubscriptionID;

    public function __construct($cn, $sd, $ed, $stat, $aid, $cid, $subid)
    {
        $this->CardNumber = $cn;
        $this->Start_Date = $sd;
        $this->End_Date = $ed;
        $this->Statut = $stat;
        $this->AgentID = $aid;
        $this->ClientID = $cid;
        $this->SubscriptionID = $subid;
    }

    public function addCard($pdo)
    {
        try {
            $req = "INSERT INTO CardSubscription (CardNumber, Start_Date, End_Date, Statut, AgentID,ClientID, SubscriptionID) 
                    VALUES (:CardNumber, :Start_Date, :End_Date, :Statut, :AgentID,:ClientID , :SubscriptionID)";

            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':CardNumber', $this->CardNumber, PDO::PARAM_STR);
            $stmt->bindParam(':Start_Date', $this->Start_Date, PDO::PARAM_STR);
            $stmt->bindParam(':End_Date', $this->End_Date, PDO::PARAM_STR);
            $stmt->bindParam(':Statut', $this->Statut, PDO::PARAM_STR);
            $stmt->bindParam(':AgentID', $this->AgentID, PDO::PARAM_STR);
            $stmt->bindParam(':ClientID', $this->ClientID, PDO::PARAM_STR);
            $stmt->bindParam(':SubscriptionID', $this->SubscriptionID, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding card: " . $e->getMessage());
        }
    }


    public function updateCard($pdo, $cardID)
    {
        try {
            $req = "UPDATE Cards
                    SET CardNumber = :CardNumber, Start_Date = :Start_Date, End_Date = :End_Date, Statut = :Statut,AgentID =:AgentID ,ClientID = :ClientID, SubscriptionID = :SubscriptionID
                    WHERE CardID = :cardID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':CardNumber', $this->CardNumber, PDO::PARAM_STR);
            $stmt->bindParam(':Start_Date', $this->Start_Date, PDO::PARAM_STR);
            $stmt->bindParam(':End_Date', $this->End_Date, PDO::PARAM_STR);
            $stmt->bindParam(':Statut', $this->Statut, PDO::PARAM_STR);
            $stmt->bindParam(':ClientID', $this->ClientID, PDO::PARAM_STR);
            $stmt->bindParam(':SubscriptionID',  $this->SubscriptionID, PDO::PARAM_INT);
            $stmt->bindParam(':cardID',  $cardID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating card: ' . $e->getMessage());
        }
    }

    public function getAllCards($pdo)
    {
        try {
            $req = "SELECT * FROM Cardsubscription";
            $stmt = $pdo->prepare($req);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error getting All Card: ' . $e->getMessage());
        }
    }


    public function deleteCard($pdo, $cardID)
    {
        try {
            $req = "DELETE FROM cards WHERE CardID = :cardID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':cardID', $cardID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting Card: ' . $e->getMessage());
        }
    }
}
