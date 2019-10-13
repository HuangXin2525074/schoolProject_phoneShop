<?php
class Item {

    private $conn;
    private $table_name = "items";

   public $ItemID;
   public $ItemName;
   public $ItemType;
   public $Color;
   public $Capacity;
   public $Display;
   public $Chip;
   public $Camera;
   public $Store;
   public $Price;
    public $error;
    public $errorOccured = false;



    public function __construct($db){
        $this->conn = $db;
    }

    function addItem()
    {
        $query = "INSERT INTO " . $this->table_name . " SET ItemName=:ItemName, ItemType=:ItemType, Color=:Color, Capacity=:Capacity, Display=:Display, Chip=:Chip, Camera=:Camera, Store=:Store, Price=:Price";
        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->ItemName=htmlspecialchars(strip_tags($this->ItemName));
        $stmt->bindParam(":ItemName", $this->ItemName);

        $this->ItemType=htmlspecialchars(strip_tags($this->ItemType));
        $stmt->bindParam(":ItemType", $this->ItemType);

        $this->Color=htmlspecialchars(strip_tags($this->Color));
        $stmt->bindParam(":Color", $this->Color);

        $this->Capacity=htmlspecialchars(strip_tags($this->Capacity));
        $stmt->bindParam(":Capacity", $this->Capacity);

        $this->Display=htmlspecialchars(strip_tags($this->Display));
        $stmt->bindParam(":Display", $this->Display);

        $this->Chip=htmlspecialchars(strip_tags($this->Chip));
        $stmt->bindParam(":Chip", $this->Chip);

        $this->Camera=htmlspecialchars(strip_tags($this->Camera));
        $stmt->bindParam(":Camera", $this->Camera);

        $this->Store=htmlspecialchars(strip_tags($this->Store));
        $stmt->bindParam(":Store", $this->Store);

        $this->Price=htmlspecialchars(strip_tags($this->Price));
        $stmt->bindParam(":Price", $this->Price);


        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        $this->error = "Unexpected error occured, try again in few minutes!";
        return false;



    }

    function editItem(){

        $query = "Update 	" . $this->table_name . " SET ItemName=:ItemName,  ItemType=:ItemType, Color=:Color, Capacity=:Capacity, Display=:Display, Chip=:Chip, Camera=:Camera, Store=:Store, Price=:Price where ItemID=:ItemID";
        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->ItemID=htmlspecialchars(strip_tags($this->ItemID));
        $stmt->bindParam(":ItemID", $this->ItemID);

        $this->ItemName=htmlspecialchars(strip_tags($this->ItemName));
        $stmt->bindParam(":ItemName", $this->ItemName);

        $this->ItemType=htmlspecialchars(strip_tags($this->ItemType));
        $stmt->bindParam(":ItemType", $this->ItemType);

        $this->Color=htmlspecialchars(strip_tags($this->Color));
        $stmt->bindParam(":Color", $this->Color);

        $this->Capacity=htmlspecialchars(strip_tags($this->Capacity));
        $stmt->bindParam(":Capacity", $this->Capacity);

        $this->Display=htmlspecialchars(strip_tags($this->Display));
        $stmt->bindParam(":Display", $this->Display);

        $this->Chip=htmlspecialchars(strip_tags($this->Chip));
        $stmt->bindParam(":Chip", $this->Chip);

        $this->Camera=htmlspecialchars(strip_tags($this->Camera));
        $stmt->bindParam(":Camera", $this->Camera);

        $this->Store=htmlspecialchars(strip_tags($this->Store));
        $stmt->bindParam(":Store", $this->Store);

        $this->Price=htmlspecialchars(strip_tags($this->Price));
        $stmt->bindParam(":Price", $this->Price);

        if($stmt->execute()){

            return true;
        }
        $this->error = "Unexpected error occured, try again in few minutes!";
        return false;

    }

    function fetchAllItem(){

        $query = "SELECT ItemID,ItemName,Color, Capacity, Display,Chip,Camera,Store, Price from $this->table_name" ;


        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;

    }

    function fetchItem(){
        // select all query
        $query = "SELECT ItemID,ItemName,ItemType,Color,Capacity, Display,Chip,Camera,Store, Price FROM  " . $this->table_name." Where ItemID=:ItemID";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $this->ItemID=htmlspecialchars(strip_tags($this->ItemID));
        $stmt->bindParam(":ItemID", $this->ItemID);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function deleteAllItem(){
        // select all query
        $query = "DELETE FROM  " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function deleteItem(){

        $query="DELETE FROM Items WHERE ItemID=:ItemID";

        $stmt = $this->conn->prepare($query);

        $this->ItemID=htmlspecialchars(strip_tags($this->ItemID));

        $stmt->bindParam(":ItemID", $this->ItemID);

        $stmt->execute();


        return $stmt;


    }

    function errorOccured(){
        $this->error = "invalid Parameters";
        $this->errorOccured = true;
        return false;
    }






























}