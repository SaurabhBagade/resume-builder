<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["full_name"] && $post["email"]) {
        $full_name = $db->real_escape_string($post["full_name"]);
        $email = $db->real_escape_string($post["email"]);
        $password = md5($db->real_escape_string($post["password"]));
        $authId = $fn->Auth()["id"];
        print_r($authId);
        if ($password == "") {
            $db->query("UPDATE users set full_name='$full_name', email='$email' where id=$authId");
        } else {
            $db->query("UPDATE users set full_name='$full_name', email='$email', password='$password' where id=$authId");
        }
        $fn->setAlert("Profile Updated Sucessfully !");
        $fn->redirect("../account.php");

    } else {
        $fn->redirect("../account.php");
    }
} else {
    $fn->redirect("../account.php");
}