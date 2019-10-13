<?php
// include database and functions files
include_once 'config/database.php';
include_once 'cart.php';
// get database connection
$database = new Database();
$db = $database->getConnection();


// prepare cart object
$cart = new cart($db);
$cart->ItemName = isset($_POST['ItemName']) ? $_POST['ItemName'] : $cart->errorOccured();
$cart->Username = isset($_POST['Username']) ? $_POST['Username'] : $cart->errorOccured();
$cart->Qty = isset($_POST['Qty']) ? $_POST['Qty'] : $cart->errorOccured();
$cart->Price = isset($_POST['Price']) ? $_POST['Price'] : $cart->errorOccured();
$cart->ItemID = isset($_POST['ItemID']) ? $_POST['ItemID'] : $cart->errorOccured();
// read the details of cart to be edited
if($cart->addItem())
{    // get retrieved row
    $res_msg=array(
			"status" => true,
			"response" => "Account cart added successfully"
			);
}
else
{
	 $res_msg=array(
					"status" => false,
					"response" => $cart->error
				); 
}

// make it json format
echo(json_encode($res_msg));
?>