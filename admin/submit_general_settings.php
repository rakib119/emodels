<?php
require_once "inc/functions.inc.php";
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
if (isset($_POST['edit_general_settings'])) {

    $flag = 0;
    $id = $_POST['id'];
    // value
    if (!$_POST['value']) {
        $_SESSION['value_error'] = "Please enter value";
        $flag = 1;
    } else {
        $value = get_safe_value($_POST['value']);
    }
    if ($flag == 0) {
        $value = get_safe_value($_POST['value']);
        $value = "value='$value'";
        $condition = "id='$id'";
        $update = update_data("general_settings", "$value", "$condition");
        if ($update) {
            $_SESSION['success'] = "General settings  successfully updated";
            header('location: general_settings.php');
        } else {
            header("location: manage_general_settings.php?id=$id&task=edit");
        }
    } else {
        header("location: manage_general_settings.php?id=$id&task=edit");
    }
}

if (isset($_GET['id']) && $_GET['task']) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    //Delete row
    if ($task == "delete") {
        $delete = delete_row("general_settings", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "One row deleted successfully";
            header('location: general_settings.php');
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("general_settings", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: general_settings.php');
        }
    }
}
