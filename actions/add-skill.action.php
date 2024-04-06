<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["skills"] && $post["resume_id"]) {
        $resumeid = array_shift($post);
        $post2 = $post;
        unset($post['slug']);
        $columns = '';
        $values = '';
        foreach ($post as $index => $v) {
            $value = $db->real_escape_string($v);
            $columns .= $index . ',';
            $values .= "'$value',";
        }
        $authId = $fn->Auth()['id'];
        $columns .= 'resume_id';
        $values .= $resumeid;
        try {
            $query = "INSERT into skills";
            $query .= "($columns)";
            $query .= " VALUES ($values)";
            // print_r($query);
            // die();
            $db->query($query);
            $fn->setAlert("Skill Added Sucessfully !");
            $fn->redirect("../updateresume.php?resume=" . $post2['slug']);
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../updateresume.php?resume=" . $post2['slug']);
        }
    } else {
        $fn->setError("Please fill the form !");
        $fn->redirect("../updateresume.php?resume=" . $post2['slug']);
    }
} else {
    $fn->redirect("../updateresume.php?resume=" . $post2['slug']);
}