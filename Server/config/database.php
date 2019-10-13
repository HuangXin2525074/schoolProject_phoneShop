<?php
class Database{
 
    // specify your own database credentials
    private $host = "E-phone2525074.epizy.com";
    private $db_name = "epiz_24453359_phoneProject";
    private $username = "epiz_24453359";
    private $password = "Nkhx-94682797";
    private $port="3306";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>