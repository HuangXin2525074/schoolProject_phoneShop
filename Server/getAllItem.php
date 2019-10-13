<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/7/2019
 * Time: 5:32 PM
 */

include_once 'config/database.php';
include_once 'item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare Apiarist object
$Item = new Item($db);
$Item->Username =isset($_POST['Username']) ? $_POST['Username'] : $Item->errorOccured();
$Item->isAdmin =isset($_POST['isAdmin']) ? $_POST['isAdmin'] : $Item->errorOccured();


$stmt = $Item->fetchAllItem();
$row="";
if($stmt->rowCount() > 0)
{
    // get retrieved row
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else
{
    $row = [];
}
// make it json format
echo(json_encode($row));
?>