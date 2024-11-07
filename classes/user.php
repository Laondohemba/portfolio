<?php

class User extends Dbconn{
    public function createUser($username, $email, $password){
        $sql = "INSERT INTO users (username, email, pass_word) VALUES (:username, :email, :pass_word);";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass_word", $password);
        $stmt->execute();

        return $stmt;
    }

    public function getUser($username){
        $sql = "SELECT * FROM users WHERE username = :username;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function insertIintroduction($userID, $image, $title, $intro){
        $sql = "INSERT INTO userprofiles(user_id, cover_image, titles, intro_proper) VALUES (:user_id, :cover_image, :titles, :intro_proper);";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":user_id", $userID);
        $stmt->bindParam(":cover_image", $image);
        $stmt->bindParam(":titles", $title);
        $stmt->bindParam(":intro_proper", $intro);
        $stmt->execute();

        return $stmt;
    }
    public function getProfile($userID){
        $sql = "SELECT user_id FROM userprofiles WHERE user_id = :user_id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();

        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        return $profile;
    }
    public function updateProfile($userID, $cover_image, $title, $intro_proper){
        $sql = "UPDATE userprofiles SET cover_image = :cover_image, titles = :titles, intro_proper = :intro_proper WHERE user_id = :user_id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":cover_image", $cover_image);
        $stmt->bindParam(":titles", $title);
        $stmt->bindParam(":intro_proper", $intro_proper);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();
        return $stmt;
    }
    public function getAllProfiles(){
        $sql = "SELECT userprofiles.*, users.username FROM userprofiles JOIN users ON userprofiles.user_id = users.id;";
        $stmt = $this->conn()->query($sql);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function getFullUserProfile($id){
        $sql = "SELECT userprofiles.*, users.username FROM userprofiles JOIN users ON userprofiles.user_id = users.id WHERE user_id = :id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        return $profile;
    }

}