<?php

class Project extends Dbconn{
    public function insertProject($name, $description, $details, $image){
        $sql = "INSERT INTO projects (name, brief_description, details, image) VALUES (?, ?, ?, ?);";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$name, $description, $details, $image]);
        return $stmt;
    }

    public function getProjects(){
        $sql = "SELECT * FROM projects;";
        $stmt = $this->conn()->query($sql);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
    }
}