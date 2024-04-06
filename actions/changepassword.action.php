<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["password"]) {
        $password = md5($db->real_escape_string($post["password"]));
        $email = $fn->getSession('email');
        $result = $db->query("UPDATE users set password='$password' where email='$email'");
        $fn->redirect('../login.php');
        $fn->setAlert('Password Changed Sucessfully !');
    } else {
        $fn->setError("Please enter your new password");
        $fn->redirect("../change-password.php");
    }
} else {
    $fn->redirect("../change-password .php");
}