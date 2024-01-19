<?php


class QueryManager
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getSubscriptionByClient($clientID)
    {
        try {
            $req = "SELECT * FROM Subscriptions WHERE ClientID = :clientID";
            $stmt = $this->pdo->prepare($req);
            $stmt->bindParam(':clientID', $clientID, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getSubscriptionByClient: " . $e->getMessage());
            return [];
        }
    }

    public function getCardByClient($clientID)
    {
        $req = "SELECT * FROM Cards WHERE ClientID = :clientID";
        $x = $this->pdo->prepare($req);
        $x->bindParam(':clientID', $clientID, PDO::PARAM_INT);
        $e = $x->execute();
        if ($e) {
            return $x->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error";
        }
    }
    public function getCardBySubscription($subscriptionID)
    {
        $req = "SELECT * FROM Cards WHERE SubscriptionID = :subscriptionID";
        $x = $this->pdo->prepare($req);
        $x->bindParam(':subscriptionID', $subscriptionID, PDO::PARAM_INT);
        $e = $x->execute();
        if ($e) {
            return $x->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error";
        }
    }

    public function getVirtualCard($clientID)
    {
        $req = "SELECT
        Clients.FirstName,
        Clients.LastName,
        CardSubscription.CardNumber,
        CardSubscription.Statut
        FROM Clients
        INNER JOIN CardSubscription ON Clients.ClientID = CardSubscription.ClientID
        WHERE
        Clients.ClientID = :clientID";
        $x = $this->pdo->prepare($req);
        $x->bindParam(':clientID', $clientID, PDO::PARAM_INT);
        $e = $x->execute();
        if ($e) {
            return $x->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error";
        }
    }


    // public function findHighestGrade($studentID)
    // {
    //     $req = "SELECT MAX(Grade) as HighestGrade, MIN(Grade) as LowestGrade FROM Registrations WHERE StudentID = :studentID";
    //     $x = $this->pdo->prepare($req);
    //     $x->bindParam(':studentID', $studentID, PDO::PARAM_INT);
    //     $e = $x->execute();
    //     if ($e) {
    //         return $x->fetchAll(PDO::FETCH_ASSOC);
    //     } else {
    //         echo "err";
    //     }
    // }
    // public function getTotalCreditHours($studentID)
    // {
    //     $req = "SELECT SUM(CreditHours) as TotalCreditHours FROM Courses
    //     INNER JOIN Registrations ON Courses.CourseID = Registrations.CourseID
    //     WHERE Registrations.StudentID = :studentID";
    //     $x = $this->pdo->prepare($req);
    //     $x->bindParam(':studentID', $studentID, PDO::PARAM_INT);
    //     $e = $x->execute();
    //     if ($e) {
    //         return $x->fetchAll(PDO::FETCH_ASSOC);
    //     } else {
    //         echo "err";
    //     }
    // }

    public function getStudentsCount()
    {
        $req = "SELECT COUNT(CASE WHEN Category = 'student' THEN 1 ELSE NULL END) as CategoryCount FROM Subscriptions
    ORDER BY CategoryCount DESC
    LIMIT 1";
        $x = $this->pdo->prepare($req);
        $e = $x->execute();
        if ($e) {
            $result = $x->fetch(PDO::FETCH_ASSOC);
            return $result['CategoryCount'];
        } else {
            echo "err";
        }
    }
    public function getPupilsCount()
    {
        $req = "SELECT COUNT(CASE WHEN Category = 'pupil' THEN 1 ELSE NULL END) as CategoryCount FROM Subscriptions
    ORDER BY CategoryCount DESC
    LIMIT 1";
        $x = $this->pdo->prepare($req);
        $e = $x->execute();
        if ($e) {
            $result = $x->fetch(PDO::FETCH_ASSOC);
            return $result['CategoryCount'];
        } else {
            echo "err";
        }
    }
    public function getEmployeeCount()
    {
        $req = "SELECT COUNT(CASE WHEN Category = 'employee' THEN 1 ELSE NULL END) as CategoryCount FROM Subscriptions
    ORDER BY CategoryCount DESC
    LIMIT 1";
        $x = $this->pdo->prepare($req);
        $e = $x->execute();
        if ($e) {
            $result = $x->fetch(PDO::FETCH_ASSOC);
            return $result['CategoryCount'];
        } else {
            echo "err";
        }
    }

    public function getCardsWithClientDetails()
    {
        $req = "SELECT
        Clients.FirstName,
        Clients.LastName,
        CardSubscription.*
        FROM Clients
        INNER JOIN CardSubscription ON Clients.ClientID = CardSubscription.ClientID";
        $x = $this->pdo->prepare($req);
        $e = $x->execute();
        if ($e) {
            return $x->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error";
        }
    }




    // public function generateRegistrationReport()
    // {
    //     $req = "SELECT Students.FirstName, Students.LastName, Courses.CourseName, Registrations.Grade
    //     FROM Students
    //     INNER JOIN Registrations ON Students.StudentID = Registrations.StudentID
    //     INNER JOIN Courses ON Registrations.CourseID = Courses.CourseID
    //     ";
    //     $x = $this->pdo->prepare($req);
    //     $e = $x->execute();
    //     if ($e) {
    //         return $x->fetchAll(PDO::FETCH_ASSOC);
    //     } else {
    //         echo "err";
    //     }
    // }
}
