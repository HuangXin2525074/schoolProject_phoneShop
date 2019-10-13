<?php


include_once "config/database.php";
include_once 'user.php';

session_start();
if(isset($_POST['action']))
{
    if($_POST['action']=='login') {

        $database = new Database();
        $db = $database->getConnection();

        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        $User = new User($db);

        $User->Username = isset($_POST['login_username']) ? $_POST['login_username'] : $User->errorOccured();
        $User->Password = isset($_POST['login_password']) ? $_POST['login_password'] : $User->errorOccured();

        $stmt = $User->loginCheck();

            // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //get retrieved row
        $_SESSION['isAdmin']= $row['isAdmin']; // check user type.
        $_SESSION['Username']=$row['Username'];

        //var_dump($_SESSION['Username']);
        header("Location: ../Webclient/data.php");

    }
}

?>