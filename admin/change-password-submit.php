<?php
require_once "inc/functions.inc.php";
if (isset($_POST['change_password'])) {

    $user_id = $_SESSION['LOGIN_ID'];
    $old_password = password_format($_POST['old_password']);
    $new_password = password_format($_POST['new_password']);
    if (!empty($old_password) && !empty($new_password)) {

        $uid = $_SESSION['LOGIN_ID'];
        $user_exist =  mysqli_num_rows(select_all("users", "*", "WHERE id='$uid' and password='$old_password'"));

        if ($user_exist) {
            $update_status = update_data("users", "password='$new_password'", "id='$uid' and password='$old_password'");
            if ($update_status) {
                $_SESSION['success'] = "Password change successfully";
                header("location: index.php");
            } else {
                $_SESSION['error'] = "Something wrong";
                header("location: index.php");
            }
        } else {
            $_SESSION['error'] = "Wrong old Password";
            header("location: index.php");
        }
    } else {
        $_SESSION['error'] = "Please give old Password and new password";
        header("location: index.php");
    }
}
