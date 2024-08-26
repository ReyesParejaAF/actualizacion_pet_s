<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "pet_stylo";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }
}
// $server = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'pet-stylo';

// try {
//     $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);

// } catch (PDOException $e) {
//     die('Connected fail:'.$e->getMessage()); 
// }
