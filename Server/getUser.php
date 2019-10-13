<?php
// include database and functions files
include_once 'config/database.php';
include_once 'user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare User object
$User = new User($db);

$User->Username =isset($_POST['Username']) ? $_POST['Username'] : $User->errorOccured();
// read the details of User to be edited
$stmt = $User->fetchUser();
$row="";
if($stmt->rowCount() > 0){
    // get retrieved row

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    $res_msg=array(
			"status" => true,
			"response" => $row
			);
}
else{
	  $res_msg=array(
			"status" => false,
			"response" => $User->error
			);
   
}

// make it json format
echo(json_encode($res_msg));
?>