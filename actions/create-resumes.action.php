<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {
    $post = $_POST;
    if ($post["full_name"] && $post["email"] && $post["objective"] && $post["mobile"] && $post["dob"] && $post["gender"] && $post["religion"] && $post["nationality"] && $post["marital_status"] && $post["hobbies"] && $post["languages"] && $post["address"]) {
        $columns = '';
        $values = '';
        foreach ($post as $index => $v) {
            $value = $db->real_escape_string($v);
            $columns .= $index . ',';
            $values .= "'$value',";
        }
        $authId = $fn->Auth()['id'];
        $columns .= 'slug, updated_at,user_id';
        $values .= "'" . $fn->randomString() . "'," . time() . "," . $authId;

        try {
            $query = "INSERT into resumes";
            $query .= "($columns)";
            $query .= " VALUES ($values)";

            $db->query($query);
            $fn->setAlert("Resume Created Sucessfully !");
            $fn->redirect("../myresumes.php");
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../createresume.php");
        }
    } else {
        $fn->setAlert("Please fill the form !");
        $fn->redirect("../createresume.php");
    }
} else {
    $fn->redirect("../createresume.php");
}