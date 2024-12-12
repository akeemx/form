<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function exists($email) {
        try {
            $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            
            if (!$query) {
                error_log("Failed to prepare SQL statement: " . $this->db->error);
            }

            $query->bind_param('s', $email);
    
            if (!$query->execute()) {
                error_log("SQL execution failed: " . $query->error);
            }
    
            $result = $query->get_result();

            return $result->num_rows > 0;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function create($name, $dob, $email) {
        try {
            $query = $this->db->prepare("INSERT INTO users (name, dob, email) VALUES (?, ?, ?)");
            
            if (!$query) {
                error_log("Failed to prepare SQL statement: " . $this->db->error);
            }
    
            $query->bind_param("sss", $name, $dob, $email);
    
            if (!$query->execute()) {
                error_log("SQL execution failed: " . $query->error);
            }
    
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function recent() {
        return $this->db->insert_id;
    }
}