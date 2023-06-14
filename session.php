<?php
session_start();
if(!isset($_SESSION['email_user'])){
    header("Location:user-login.php");
}

?>