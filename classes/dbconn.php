<?php

class Dbconn{ 
    private $host = "localhost";
    private $dbname = "portfolio";
    private $dbusername = "root";
    private $dbpassword = "";
    private $port = 3307;

    protected function conn(){
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" . $this->port;

        try {
            // Create a new PDO instance
            $pdo = new PDO($dsn, $this->dbusername, $this->dbpassword);
            
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;  // Return the PDO instance for use in other classes
            
        } catch (PDOException $e) {
            // Output a more descriptive error message
            die("Connection failed: " . $e->getMessage());
        }
    }
}
