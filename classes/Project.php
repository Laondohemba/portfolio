<?php

class Project extends Dbconn{
    public function insertProject($userID, $name, $description, $details, $image){
        $sql = "INSERT INTO projects (user_id, name, brief_description, details, image) VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$userID, $name, $description, $details, $image]);
        return $stmt;
    }

    public function getProjects($userID){
        $sql = "SELECT * FROM projects WHERE user_id = :user_id ORDER BY id DESC;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
    }

    public function getProjectForEdit($id){
        $sql = "SELECT * FROM projects WHERE id = :id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $projects = $stmt->fetch(PDO::FETCH_ASSOC);
        return $projects;
    }

    public function editProject($userID, $id, $name, $description, $details, $image){
        $sql = "UPDATE projects SET user_id = :user_id, name = :name, brief_description = :brief_description, details = :details, image = :image WHERE id = :id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":user_id", $userID);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":brief_description", $description);
        $stmt->bindParam(":details", $details);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function deleteProject($id){
        $sql = "DELETE FROM projects WHERE id = :id;";
        $stmt = $this->conn()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }
}