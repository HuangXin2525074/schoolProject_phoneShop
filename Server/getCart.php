<?php
include_once 'config/database.php';
include_once 'cart.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare cart object
$cart = new cart($db);
$cart->Username =isset($_POST['Username']) ? $_POST['Username'] : $cart->errorOccured();


$stmt = $cart->fetchCartItem();
$rows=[];


// get retrieved row
$row = $stmt->fetchAll();


foreach ($row as $value)
{
        $rows[]=$value;
}


// make it json format
echo(json_encode($rows));
?>


