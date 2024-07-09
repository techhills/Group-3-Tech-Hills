<?php
if (!defined('DB_SERVER')) {
    require_once("../initialize.php");
}
class DBConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "tech_db";

    public $conn;

    public function __construct()
    {
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                echo 'Cannot connect to database server: ' . $this->conn->connect_error;
                exit;
            }
        }
    }
    public function __destruct()
    {
        $this->conn->close();
    }
}
