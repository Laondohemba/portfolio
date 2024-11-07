<?php

class Messages extends Dbconn{
    public function insertMessage($userID, $name, $email, $message){
        $sql = "INSERT INTO messages (user_id, name, email, message_body) VALUES (:user_id, :name, :email, :message_body);";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":user_id", $userID);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":message_body", $message);
        $stmt->execute();
        return $stmt;
    }

    public function getMessages($userID){
        $sql = "SELECT * FROM messages WHERE user_id = $userID;";
        $stmt = $this->conn()->query($sql);
        $stmt->execute();
        
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }
}