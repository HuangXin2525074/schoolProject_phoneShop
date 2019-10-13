<?php
// include database and functions files
include_once 'config/database.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$OrderID=$_POST['OrderID'];

$query="SELECT *FROM phoneuser INNER JOIN orders ON phoneuser.Username = orders.Username WHERE OrderID=:OrderID";

$stmt = $db->prepare($query);

$OrderID=htmlspecialchars(strip_tags($OrderID));
$stmt->bindParam(":OrderID", $OrderID);

$stmt->execute();

$row="";
if($stmt->rowCount() > 0)
{
	  //get retrieved row
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);  
      $res_msg=array(
			"status" => true,
			"response" => $row
			);
}
else
{
	  $res_msg=array(
			"status" => false,
			"response" => "error"
			);
   
}
// make it json format
echo(json_encode($res_msg));
?>