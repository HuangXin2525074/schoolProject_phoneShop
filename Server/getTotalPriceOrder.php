<?php
include_once 'config/database.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

$OrderID=$_POST['OrderID'];

$query="SELECT SUM(Price) AS totalPrice FROM orders WHERE OrderID=:OrderID";

$stmt = $db->prepare($query);

$Username=htmlspecialchars(strip_tags($OrderID));
$stmt->bindParam(":OrderID", $OrderID);

$stmt->execute();


$row = $stmt->fetch();



// make it json format
echo(json_encode($row));