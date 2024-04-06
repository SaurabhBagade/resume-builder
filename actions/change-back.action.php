<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["resume_id"] && $post["background"]) {
        $background = $db->real_escape_string($post["background"]);
        $query = "UPDATE resumes set ";
        $query .= "background = '$background' WHERE id ={$post['resume_id']}";
        // print_r($query);
        // die();
        $db->query($query);
        $fn->setAlert("Resume Updated Sucessfully !");
        $fn->redirect("../myresumes.php");

    } else {
        $fn->setAlert("Please fill the form !");
        $fn->redirect("../updateresume.php?resume=" . $post['slug']);
    }
} else {
    $fn->redirect("../updateresume.php?resume=" . $post['slug']);
}