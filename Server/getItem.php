<?php
// include database and functions files
include_once 'config/database.php';
include_once 'item.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare item object
$Item = new Item($db);
$Item->ItemID = isset($_POST['ItemID']) ? $_POST['ItemID'] : $Item->errorOccured();
// read the details of Item to be edited
$stmt = $Item->fetchItem();
$row="";
if($stmt->rowCount() > 0)
{
    // get retrieved row
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);  
     $res_msg=array(
			"status" => true,
			"response" => $row
			);
}
else{
	  $res_msg=array(
			"status" => true,
			"response" => $Item->error
			);
   
}
// make it json format
echo(json_encode($res_msg));
?>