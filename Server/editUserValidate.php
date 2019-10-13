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
$User->Email = isset($_POST['Email']) ? $_POST['Email'] : "";

$res_msg=array(
	"statusEmail" => $User->isEmailAlreadyExistEdit()
); 

// make it json format
echo(json_encode($res_msg));
?>