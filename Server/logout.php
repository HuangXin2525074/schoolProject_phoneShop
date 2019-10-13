<?php
session_start();
include_once 'config/database.php';
include_once 'cart.php';


// once login out the cart is empty;
$database = new Database();
$db = $database->getConnection();

$Username= $_SESSION["Username"];

$cart = new cart($db);
$cart->Username = $Username;

$stmt= $cart->clearCart();

$row = $stmt->fetch();


unset($_SESSION["Username"]); 
unset($_SESSION["IsAdmin"]); // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location:../Webclient/index.php");
?>