<?php
include_once 'config/database.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

$Username =$_POST['Username'];
$isAdmin =$_POST['isAdmin'];

$query = "SELECT ItemID,ItemName,Color, Capacity, Display,Chip,Camera,Store, Price from items WHERE Itemtype='xiaomi'";

$stmt = $db->prepare($query);
// execute query
$stmt->execute();


$row="";
if($stmt->rowCount() > 0)
{
    // get retrieved row
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{
    $row = [];
}
// make it json format
echo(json_encode($row));
?>