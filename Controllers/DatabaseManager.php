<?php


require_once('./config/config.php');
class DataBaseManger
{
    public static function createTables($pdo)
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS Administrators(
            AdminID INT AUTO_INCREMENT,
            FirstName varchar(50),
            LastName varchar(50),
            Email varchar(50),
            Password varchar(255),
            PRIMARY KEY (`AdminID`)
            );


        CREATE TABLE IF NOT EXISTS Agents (
            AgentID INT AUTO_INCREMENT,
            FirstName varchar(50),
            LastName varchar(50),
            DateOfBirth DATE,
            Email varchar(50),
            Password varchar(255),
            AdminId INT,
            PRIMARY KEY (`AgentID`),
            FOREIGN KEY (AdminID) REFERENCES Administrators(AdminID)
           );

        CREATE TABLE IF NOT EXISTS Clients(
            ClientID INT AUTO_INCREMENT,
            FirstName varchar(50),
            LastName varchar(50),
            DateOfBirth DATE,
            Email varchar(50),
            Phone INT,
            Password varchar(255),
            Gender varchar(50),
            Avatar varchar(50),
            Adresse varchar(50),
            AgentID INT,
            AdminID INT,
            PRIMARY KEY (`ClientID`),
            FOREIGN KEY (AdminID) REFERENCES Administrators(AdminID),
            FOREIGN KEY (AgentID) REFERENCES Agents(AgentID)
        );
  

        CREATE TABLE IF NOT EXISTS Documents (
            DocumentID INT AUTO_INCREMENT,
            ClientID INT,
            FileName VARCHAR(50),
            FileType VARCHAR(50),
            FilePath VARCHAR(50),
            UploadDate DATETIME,
            PRIMARY KEY (`DocumentID`),
            FOREIGN KEY (ClientID) REFERENCES Clients(ClientID)
            );

        CREATE TABLE IF NOT EXISTS Subscriptions(
            SubscriptionID INT AUTO_INCREMENT,
            Type varchar(50),
            Start_Date DATE,
            End_Date DATE,
            Category varchar(50),
            Plan varchar(50),
            Amount INT,
            AgentID INT,
            ClientID INT,
            PRIMARY KEY (`SubscriptionID`),
            FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),
            FOREIGN KEY (AgentID) REFERENCES Agents(AgentID)
            );
    
        CREATE TABLE IF NOT EXISTS CardSubscription(
            CardID INT AUTO_INCREMENT,
            CardNumber INT,
            Start_Date DATE,
            End_Date DATE,
            Statut varchar(50),
            AgentID INT,
            ClientID INT,
            SubscriptionID INT,
            PRIMARY KEY (`CardID`),
            FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),
            FOREIGN KEY (SubscriptionID) REFERENCES Subscriptions(SubscriptionID),
            UNIQUE(CardNumber)
        )
        ";

        $x = $pdo->prepare($sql);
        $e = $x->execute();
        if ($e) {
            echo "Tables created successfully";
        } else {
            echo "Tables creation failed";
        }
    }
}
