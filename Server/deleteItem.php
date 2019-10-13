<?php
// include database and functions files
include_once 'config/database.php';
include_once 'item.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
$Item = new Item($db);
$Item->ItemID=isset($_POST['ItemID']) ? $_POST['ItemID'] : $Item->errorOccured();

// prepare Apiarist object
// read the details of Apiarist to be edited
$stmt = $Item->deleteItem();
if($stmt->rowCount()>0)
{
	 $res_msg=array(
			"status" => true,
			"response" => "Record deleted successfully"
			);  
}
else
{
	 $res_msg=array(
			"status" => false,
			"response" => "Error while deleteing.Foreign key constraint.."
			);
}
// make it json format
echo(json_encode($res_msg));
?>