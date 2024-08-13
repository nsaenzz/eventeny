<?php
namespace App\Database;

use PDO;
use PDOException;

class Database
{

    private $db_host;
    private $db_username;
    private $db_password;
    private $db_name;
    private $port;
    private $conn;

    public function __construct()
    {  
        $this->db_host = MYSQL_HOST;
        $this->db_username = MYSQL_USER;
        $this->db_password = MYSQL_ROOT_PASSWORD;
        $this->db_name = MYSQL_DATABASE;
        $this->port = MYSQL_PORT;
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:dbname=$this->db_name;host=$this->db_host;port=$this->port";
        try{ 
            $this->conn = new PDO($dsn, $this->db_username, $this->db_password);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $data=[])
    {
        $stm = $this->conn->prepare($query);
        $check = $stm->execute($data);
        if($check) {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        return false;
    }
}