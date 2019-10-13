<?php
// include database and functions files
include_once 'config/database.php';
include_once 'item.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare Item object
$Item = new Item($db);
$Item->ItemID = isset($_POST['ItemID'])? $_POST['ItemID']:$Item->errorOccured();
$Item->ItemName = isset($_POST['ItemName']) ? $_POST['ItemName'] : $Item->errorOccured();
$Item->ItemType = isset($_POST['ItemType']) ? $_POST['ItemType'] : $Item->errorOccured();
$Item->Color = isset($_POST['Color']) ? $_POST['Color'] : $Item->errorOccured();
$Item->Capacity = isset($_POST['Capacity']) ? $_POST['Capacity'] :$Item->errorOccured();
$Item->Display = isset($_POST['Display']) ? $_POST['Display'] : $Item->errorOccured();
$Item->Chip = isset($_POST['Chip']) ? $_POST['Chip'] : $Item->errorOccured();
$Item->Camera = isset($_POST['Camera']) ? $_POST['Camera'] : $Item->errorOccured();
$Item->Store = isset($_POST['Store']) ? $_POST['Store'] : $Item->errorOccured();
$Item->Price = isset($_POST['Price']) ? $_POST['Price'] : $Item->errorOccured();
// read the details of Apiarist to be edited
if($Item->editItem())
{    // get retrieved row
    $res_msg=array(
			"status" => true,
			"response" => "Item updated successfully"
			);
}
else
{
	 $res_msg=array(
					"status" => false,
					"response" => $Item->error
				); 
}

// make it json format
echo(json_encode($res_msg));
?>