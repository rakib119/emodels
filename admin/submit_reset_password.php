<?php
require_once "inc/functions.inc.php";
if (!isAdmin()) {
    rejected();
} else {
    if (isset($_POST['reset_password'])) {
        if ($_POST['password']) {
            $password = password_format($_POST['password']);
        }
        $id = base64_decode($_POST['id']);
        if (update_data('users', "password='$password'", "id='$id'")) {
            $_SESSION['success'] = "Password reset successfully";
            header("location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['error'] = "some thing went wrong";
            header("location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}
