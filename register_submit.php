<?php
require_once("admin/inc/functions.inc.php");
if (isset($_POST['submit'])) {
    // pr($_POST);
    // die();
    $name = name_format($_POST['name']);
    $reference = get_safe_value($_POST['reference']);
    $mobile = get_safe_value($_POST['mobile']);
    $password = get_safe_value($_POST['password']);
    $confirm_password = get_safe_value($_POST['confirm_password']);
    $error_flag = 0;

    if (!$name) {
        $error_flag = 1;
        $_SESSION['name_error'] = "Please enter your name";
    } else {
        $_SESSION['old_name'] =  $name;
    }

    if (!$mobile) {
        $error_flag = 1;
        $_SESSION['mobile_error'] = "Please enter your mobile";
    } else {
        $cheak = mysqli_num_rows(select_all('users', '*', "where mobile='$mobile'"));
        if ($cheak > 0) {
            $error_flag = 1;
            $_SESSION['mobile_error'] = "mobile already exist..";
        } else {
            if (!valid_phone_number($_POST['mobile'])) {
                $error_flag = 1;
                $_SESSION['mobile_error'] = "Please enter valid number";
            } else {
                $_SESSION['old_mobile'] =  $mobile;
            }
        }
    }
    if ($reference) {
        $_SESSION['old_reference'] =  $reference;
    }
    if (!$password) {
        $error_flag = 1;
        $_SESSION['password_error'] = "Please enter a password";
    }

    if (!$confirm_password) {
        $error_flag = 1;
        $_SESSION['confirm_password_error'] = "Please Re-type your password";
    } else {
        if ($password != $confirm_password) {
            $error_flag = 1;
            $_SESSION['confirm_password_error'] = "Password and confirm password does not matched";
        } else {
            $password = password_format($_POST['password']);
        }
    }

    if ($error_flag == 1) {
        header("location: register.php");
    } else {
        $create_at = date("Y-m-d H:i:s");
        $column_name = "name,role_id,reference,mobile,password,status";
        $values = "'$name','3','$reference','$mobile','$password','0'";
        $sql = insert_query("users", $column_name, $values);
        if ($sql) {
            $_SESSION['success'] = "Registration Successful";
            header('location: register.php');
        } else {
            $_SESSION['reg_error'] = "Faild to Register";
            header("location: register.php");
        }
    }
}

if (isset($_GET['id']) && $_GET['task']) {
    $id = $_GET["id"];
    $task = $_GET["task"];

    if ($task == "delete") {
        $delete = delete_row("users", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "One row deleted successfully";
            header('location: user_list.php');
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("users", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: user_list.php');
        }
    }
}
