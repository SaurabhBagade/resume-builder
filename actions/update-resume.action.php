<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["full_name"] && $post["email"] && $post["objective"] && $post["mobile"] && $post["dob"] && $post["gender"] && $post["religion"] && $post["nationality"] && $post["marital_status"] && $post["hobbies"] && $post["languages"] && $post["address"] && $post['id'] && $post['slug']) {
        $post2 = $post;
        unset($post2['id']);
        unset($post2['slug']);
        $columns = '';
        foreach ($post2 as $index => $v) {
            $value = $db->real_escape_string($v);
            $columns .= $index . "= '$value',";
        }
        $columns .= 'updated_at=' . time();
        try {
            $query = "UPDATE resumes set ";
            $query .= "$columns";
            $query .= " WHERE id ={$post['id']} and slug ='{$post['slug']}'";
            // print_r($query);
            // die();
            $db->query($query);
            $fn->setAlert("Resume Updated Sucessfully !");
            $fn->redirect("../myresumes.php");
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../updateresume.php?resume=" . $post['slug']);
        }
    } else {
        $fn->setAlert("Please fill the form !");
        $fn->redirect("../updateresume.php?resume=" . $post['slug']);
    }
} else {
    $fn->redirect("../updateresume.php?resume=" . $post['slug']);
}