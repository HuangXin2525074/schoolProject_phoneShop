<?php
// include database and functions files
include_once 'config/database.php';
include_once 'user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare User object
$User = new User($db);
$User->Username = isset($_POST['Username']) ? $_POST['Username'] : "";
$User->Password = isset($_POST['Password']) ? $_POST['Password'] : "";

$res_msg=array(
	"status" => $User->resetPassword()
); 

// make it json format
echo(json_encode($res_msg));
?>