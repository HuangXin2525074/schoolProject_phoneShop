<?php
include_once 'config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$OrderID =$_POST['OrderID'];
$Username =$_POST['Username'];
$ItemName =$_POST['ItemName'];
$Qty =$_POST['Qty'];
$Price =$_POST['Price'];


$query = "INSERT INTO orders SET OrderID=:OrderID,Username=:Username,ItemName=:ItemName,Qty=:Qty,Price=:Price,OrderDate=CURDATE()";

// prepare query statement
$stmt = $db->prepare($query);


$OrderID=htmlspecialchars(strip_tags($OrderID));
$stmt->bindParam(":OrderID", $OrderID);

$Username=htmlspecialchars(strip_tags($Username));
$stmt->bindParam(":Username", $Username);

$ItemName=htmlspecialchars(strip_tags($ItemName));
$stmt->bindParam(":ItemName", $ItemName);

$Qty=htmlspecialchars(strip_tags($Qty));
$stmt->bindParam(":Qty", $Qty);

$Price=htmlspecialchars(strip_tags($Price));
$stmt->bindParam(":Price", $Price);

// execute query
if($stmt->execute())
{
    $res_msg=array(
        "status" => true,
        "OrderID" =>$OrderID,
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


// make it json format
echo(json_encode($res_msg));
?>