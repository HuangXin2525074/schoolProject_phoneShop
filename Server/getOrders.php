<?php
include_once 'config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$Username =$_POST['Username'];

$query ="SELECT* FROM orders WHERE Username=:Username";

$stmt = $db->prepare($query);

$Username=htmlspecialchars(strip_tags($Username));
$stmt->bindParam(":Username", $Username);

$stmt->execute();
$rows=[];
$row = $stmt->fetchAll();


foreach ($row as $value)
{
    $rows[]=$value;
}


// make it json format
echo(json_encode($rows));