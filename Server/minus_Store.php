<?php

include_once 'config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$ItemID =$_POST['ItemID'];
$Qty =$_POST['Qty'];



$query="UPDATE items SET Store=Store-:Qty WHERE ItemID=:ItemID";


$stmt = $db->prepare($query);

$Qty=htmlspecialchars(strip_tags($Qty));
$stmt->bindParam(":Qty", $Qty);

$ItemID =htmlspecialchars(strip_tags($ItemID));
$stmt->bindParam(":ItemID", $ItemID);


// execute query
if($stmt->execute())
{
    $res_msg=array(
        "status" => true,
        "response" => "Item added successfully"
    );
}
else
{
    $res_msg=array(
        "status" => false,
        "response" => "Error"
    );
}




echo(json_encode($res_msg));