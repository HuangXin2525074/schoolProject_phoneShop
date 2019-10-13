<?php
// include database and functions files
include_once 'config/database.php';
include_once 'user.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

$User = new User($db);
$User->Username =isset($_POST['Username']) ? $_POST['Username'] : $User->errorOccured();

$stmt = $User->deleteUser();

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