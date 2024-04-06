<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_GET) {
    $get = $_GET;
    if ($get["id"]) {
        try {
            $resumeQuery = "DELETE from resumes where id={$get['id']}";
            $expQuery = "DELETE from education where resume_id={$get['id']}";
            $eduQuery = "DELETE from experience where resume_id={$get['id']}";
            $skillsQuery = "DELETE from skills where resume_id={$get['id']}";
            $db->query($resumeQuery);
            $db->query($expQuery);
            $db->query($eduQuery);
            $db->query($skillsQuery);
            $fn->setAlert("Resume Deleted Sucessfully !");
            $fn->redirect("../myresumes.php");
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../myresumes.php");
        }
    } else {
        $fn->setError("Please fill the form !");
        $fn->redirect("../myresumes.php");
    }
} else {
    $fn->redirect("../myresumes.php");
}