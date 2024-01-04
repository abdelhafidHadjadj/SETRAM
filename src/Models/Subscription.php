<?php
class Subscription
{
    private $Type,
        $Start_Date,
        $End_Date,
        $AgentID,
        $ClientID,
        $Amount,
        $Category,
        $Plan;


    public function __construct($typ, $sd, $aid, $cid, $ed, $am, $cat, $pl)
    {
        $this->Type = $typ;
        $this->Start_Date = $sd;
        $this->End_Date = $ed;
        $this->AgentID = $aid;
        $this->ClientID = $cid;
        $this->Amount = $am;
        $this->Category = $cat;
        $this->Plan = $pl;
    }

    public function addSubscription($pdo)
    {
        try {
            $req = "INSERT INTO Subscriptions (Type, Start_Date, End_Date, Amount, AgentID ,ClientID, Category, Plan) 
                    VALUES (:Type, :Start_Date, :End_Date, :Amount, :AgentID,:ClientID, :Category, :Plan)";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':Type', $this->Type, PDO::PARAM_STR);
            $stmt->bindParam(':Start_Date', $this->Start_Date, PDO::PARAM_STR);
            $stmt->bindParam(':End_Date', $this->End_Date, PDO::PARAM_STR);
            $stmt->bindParam(':AgentID', $this->AgentID, PDO::PARAM_STR);
            $stmt->bindParam(':ClientID', $this->ClientID, PDO::PARAM_STR);
            $stmt->bindParam(':Amount', $this->Amount, PDO::PARAM_STR);
            $stmt->bindParam(':Category', $this->Category, PDO::PARAM_STR);
            $stmt->bindParam(':Plan', $this->Plan, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding Subscription: " . $e->getMessage());
        }
    }
    // Hna ki tbdl certain champs li mytbdloch dirhom null fl obj
    public function updateSubscription($pdo, $subscriptionID)
    {
        try {
            $req = "UPDATE Subscriptions
                    SET Type = :Type, Start_Date = :Start_Date, End_Date = :End_Date, Amount = :Amount, ClientID = :ClientID, Category = :Category, Plan = : Plan
                    WHERE SubscriptionID = :subscriptionID 
                    ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':Type', $this->Type, PDO::PARAM_STR);
            $stmt->bindParam(':Start_Date', $this->Start_Date, PDO::PARAM_STR);
            $stmt->bindParam(':End_Date', $this->End_Date, PDO::PARAM_STR);
            $stmt->bindParam(':Amount', $this->Amount, PDO::PARAM_STR);
            $stmt->bindParam(':AgentID', $this->AgentID, PDO::PARAM_STR);
            $stmt->bindParam(':ClientID', $this->ClientID, PDO::PARAM_STR);
            $stmt->bindParam(':Category', $this->Category, PDO::PARAM_STR);
            $stmt->bindParam(':Plan', $this->Plan, PDO::PARAM_STR);
            $stmt->bindParam(':subscriptionID', $subscriptionID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating Subscription: ' . $e->getMessage());
        }
    }

    public function deleteSubscription($pdo, $subscriptionID)
    {
        try {
            $req = "DELETE FROM Subscriptions WHERE SubscriptionID = :subscriptionID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':subscriptionID', $subscriptionID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting Subscription: ' . $e->getMessage());
        }
    }
}
