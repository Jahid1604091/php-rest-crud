<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $db_username = 'root';
    private $db_password = '';
    private $conn;

    //db connect
    public function dbConnect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error : '.$e->getMessage();
        }

        return $this->conn;
    }
}
