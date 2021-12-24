<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_faq'])) {

    $flag = 0;
    // question
    if (!$_POST['question']) {
        $_SESSION['question_error'] = "Please enter question";
        $flag = 1;
    } else {
        $question = get_safe_value($_POST['question']);
        $_SESSION['old_question'] = $question;
    }
    // answere
    if (!$_POST['answere']) {
        $_SESSION['answere_error'] = "Please enter answere";
        $flag = 1;
    } else {
        $answere = get_safe_value($_POST['answere']);
        $_SESSION['old_answere'] = $answere;
    }
    if ($flag == 0) {
        $created_at = date("Y-m-d H:i:s");
        unset($_SESSION['old_question']);
        unset($_SESSION['old_answere']);

        $column_name = "question,answere,created_at";
        $values = "'$question','$answere','$created_at'";
        if (insert_query("faq", $column_name, $values)) {
            $_SESSION['success'] = "Faq added successfully";
            header('location: faq.php');
        }
    } else {
        header('location: manage_faq.php');
    }
}
if (isset($_POST['edit_faq'])) {

    $id = $_SESSION['edit_faq_id'];
    unset($_SESSION['edit_faq_id']);
    $flag = 0;
    // question
    if (!$_POST['question']) {
        $_SESSION['question_error'] = "Please enter question";
        $flag = 1;
    }
    // news description
    if (!$_POST['answere']) {
        $_SESSION['answere_error'] = "Please enter answere";
        $flag = 1;
    }

    if ($flag == 0) {
        $faq = mysqli_fetch_assoc(select_all("faq", "*", "WHERE id='$id'"));
        //file uploading
        $question = get_safe_value($_POST['question']);
        $answere = get_safe_value($_POST['answere']);
        $values = "question = '$question',answere = '$answere'";
        $update = update_data("faq", "$values", "id='$id'");
        if ($update) {
            $_SESSION['success'] = "faq update successfully";
            header('location: faq.php');
        } else {
            header("location: manage_faq.php?id=$id&task=edit");
        }
    } else {
        header("location: manage_faq.php?id=$id&&task=edit");
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    //update status
    if ($task == "update_status") {
        $update_status = update_status("faq", "$id");
        if ($update_status) {
            $_SESSION['success'] = "status successfully updated";
            header('location: faq.php');
        }
    }
    if ($task == "delete") {
        if (delete_row("faq", "id='$id'")) {
            $_SESSION['success'] = "faq deleted successfully";
            header('location: faq.php');
        }
    }
}
