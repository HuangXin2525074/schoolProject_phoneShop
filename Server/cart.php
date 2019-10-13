<?php

class cart {

    private $conn;
    private $table_name ="myCart";

    public $CartNo;
    public $ItemName;
    Public $Username;
    public $Qty;
    public $ItemID;
    public $Price;
    public $error;
    public $errorOccured = false;

    public function __construct($db){
        $this->conn = $db;
    }

    function addItem()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Username=:Username, ItemName=:ItemName, ItemID=:ItemID, Qty=:Qty, Price=:Price";
        // prepare query
        $stmt = $this->conn->prepare($query);



        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $stmt->bindParam(":Username", $this->Username);

        $this->ItemName=htmlspecialchars(strip_tags($this->ItemName));
        $stmt->bindParam(":ItemName", $this->ItemName);

        $this->ItemID=htmlspecialchars(strip_tags($this->ItemID));
        $stmt->bindParam(":ItemID", $this->ItemID);

        $this->Qty=htmlspecialchars(strip_tags($this->Qty));
        $stmt->bindParam(":Qty", $this->Qty);

        $this->Price=htmlspecialchars(strip_tags($this->Price));
        $stmt->bindParam(":Price", $this->Price);


        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        $this->error = "Unexpected error occured, try again in few minutes!";
        return false;

    }

    function fetchCartItem(){

        $query = "SELECT ItemName, ItemID, Qty, Price FROM $this->table_name WHERE Username=:Username";


        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $stmt->bindParam(":Username",$this->Username);
        // execute query
        $stmt->execute();
        return $stmt;

    }

    function clearCart()
    {
        $query="DELETE FROM $this->table_name WHERE Username=:Username";
        $stmt = $this->conn->prepare($query);

        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $stmt->bindParam(":Username", $this->Username);

        $stmt->execute();
        return $stmt;
    }

    function getTotalPrice()
    {
        $query="SELECT SUM(Price) AS total FROM $this->table_name WHERE Username=:Username";

        $stmt = $this->conn->prepare($query);

        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $stmt->bindParam(":Username", $this->Username);

        $stmt->execute();
        return $stmt;

    }

    function errorOccured(){
        $this->error = "invalid Parameters";
        $this->errorOccured = true;
        return false;
    }















}