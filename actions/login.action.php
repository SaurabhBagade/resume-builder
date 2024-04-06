<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["email"] && $post["password"]) {
        $email = $db->real_escape_string($post["email"]);
        $password = md5($db->real_escape_string($post["password"]));

        $result = $db->query("SELECT * from users where email='$email' and password='$password'");
        $result = $result->fetch_assoc();

        if ($result) {
            $fn->setAuth($result);
            $fn->redirect('../myresumes.php');
            $fn->setAlert('Logged in Sucessfully !');
        } else {
            $fn->setError("Incorrect Email id or Password !");
            $fn->redirect("../register.php");
        }
    } else {
        $fn->redirect("../register.php");
    }
} else {
    $fn->redirect("../register.php");
}
