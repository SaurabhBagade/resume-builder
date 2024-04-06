<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_GET) {
    $get = $_GET;
    if ($get["id"] && $get['resume_id'] && $get['slug']) {
        try {
            // print_r($get);
            // die();
            $query = "DELETE from skills where id={$get['id']} and resume_id={$get['resume_id']}";
            $db->query($query);
            $fn->setAlert("Skill Deleted Sucessfully !");
            $fn->redirect("../updateresume.php?resume=" . $get['slug']);
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../updateresume.php?resume=" . $get['slug']);
        }
    } else {
        $fn->setError("Please fill the form !");
        $fn->redirect("../updateresume.php?resume=" . $get['slug']);
    }
} else {
    $fn->redirect("../updateresume.php?resume=" . $get['slug']);
}