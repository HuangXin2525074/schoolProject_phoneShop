<?php

// include database and functions files
include_once 'config/database.php';
include_once 'user.php';

// get database connection
$database= new Database();
$db = $database->getConnection();

// prepare User object
$User = new User($db);
$User->Username = isset($_POST['Username']) ? $_POST['Username'] : $User->errorOccured();
$User->Password = isset($_POST['Password']) ? $_POST['Password'] : $User->errorOccured();

// read the details of User to be edited
$stmt = $User->loginCheck();
$row="";

if($stmt->rowCount() >0)
{
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //get retrieved row
    $res_msg=array(
        "status" => true
    );
}
else
{
    $res_msg=array(
        "status" => false
    );
}
// make it json format
echo(json_encode($res_msg));

?>

