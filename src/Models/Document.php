<?php

class Document
{
    public $clientID, $fileName, $filePath, $uploadDate;
    function __construct($clID, $fn, $fp, $upd)
    {
        $this->clientID = $clID;
        $this->fileName = $fn;
        $this->filePath = $fp;
        $this->uploadDate = $upd;
    }

    function addDocument($pdo)
    {
        try {
            $req = "INSERT INTO Documents(ClientID, FileName, FilePath, UploadDate)
            VALUES(:clientID, :fileName, :filePath, :uploadDate)
            ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':clientID', $this->clientID, PDO::PARAM_STR);
            $stmt->bindParam(':fileName', $this->fileName, PDO::PARAM_STR);
            $stmt->bindParam(':filePath', $this->filePath, PDO::PARAM_STR);
            $stmt->bindParam(':uploadDate', $this->uploadDate, PDO::PARAM_STR);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding documents" . $e->getMessage());
        }
    }
    public function updateDocument($pdo, $documentID)
    {
        try {
            $req = "UPDATE Documents
                    SET ClientID = :clientID, FileName = :fileName, FilePath = :filePath, UploadDate = :uploadDate
                    WHERE DocumentID = :documentID 
                    ";
        } catch (PDOException $e) {
            error_log('Error updating document: ' . $e->getMessage());
        }
    }
    public function deleteDocument($pdo, $documentID)
    {
        try {
            $req = "DELETE FROM Documents WHERE DocumentID = :documentID";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':documentID', $documentID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error deleting Document: ' . $e->getMessage());
        }
    }
}
