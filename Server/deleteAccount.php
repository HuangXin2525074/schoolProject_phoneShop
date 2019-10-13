<?php
include_once 'config/database.php';
include_once 'deleteuser.php';
$database = new Database();
$db = $database->getConnection();
$id=$_GET['id'];


$deleteuser= new deleteUser($db);

$UserAccount= $deleteuser->delete_User($id);

var_dump($UserAccount);

header("location:../Webclient/index.php");

?>