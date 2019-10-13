<?php
include_once 'config/database.php';
include_once 'cart.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare cart object
$cart = new cart($db);
$cart->Username =isset($_POST['Username']) ? $_POST['Username'] : $cart->errorOccured();


$stmt= $cart->clearCart();

$row = $stmt->fetch();

$res_msg=array(
    "status" => true
    );

echo(json_encode($res_msg));