<?php
class Database {
    private $host = "HOST";
    private $username = "USERNAME";
    private $password = "PASSWORD";
    private $dbName = "DB_NAME";
    private $conn;
    
    public function connect() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);

            if ($this->conn->connect_error) {
                error_log("Database connection failed: " . $this->conn->connect_error);
            }

            if (!$this->conn->set_charset("utf8mb4")) {
                error_log("Error setting charset: " . $this->conn->error);
            }
    
            return $this->conn;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            die("Failed to connect to database, please try again later.");
        }
    }
}