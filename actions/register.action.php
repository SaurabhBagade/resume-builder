<?php
session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["full_name"] && $post["email"] && $post["password"]) {
        $full_name = $db->real_escape_string($post["full_name"]);
        $email = $db->real_escape_string($post["email"]);
        $password = md5($db->real_escape_string($post["password"]));

        $result = $db->query("SELECT count(*) as user from users where email='$email'");
        $result = $result->fetch_assoc();

        if ($result['user']) {
            $fn->setError($email . " is already registered !");
            $fn->redirect("../register.php");
            die();
        }
        try {
            
            $db->query("INSERT INTO users(full_name, email, password) values ('$full_name','$email','$password')");
            $fn->setAlert("You are successfully registered !");
            $fn->redirect("../register.php");
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    } else {
        $fn->redirect("../register.php");
    }
} else {
    $fn->redirect("../register.php");
}
