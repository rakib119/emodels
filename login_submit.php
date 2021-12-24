<?php
require_once("admin/inc/functions.inc.php");
$flag = 0;
if (isset($_POST['model_login'])) {
    if (!$_POST['mobile']) {
        $flag = 1;
        $_SESSION['mobile_error'] = "Please enter your mobile number";
    }
    if (!$_POST['password']) {
        $flag = 1;
        $_SESSION['password_error'] = "Please enter your Password";
    }
    $target_id = get_safe_value($_POST['target_id']);
    if ($flag != 1) {
        pr($_POST);
        $mobile = valid_phone_number($_POST['mobile']);
         $password = password_format($_POST['password']);
    //   die();
        $sql = select_all('users', '*', "WHERE mobile='$mobile' AND password='$password' AND status=1");
        $row = mysqli_num_rows($sql);
        if ($row == 1) {
            $login_info = mysqli_fetch_assoc($sql);
            $status = true;
            if ($login_info['role_id'] == 1) {
                $_SESSION["ROLE"] = 'ADMIN';
            } elseif ($login_info['role_id'] == 2) {
                $_SESSION["ROLE"] = 'MODEL';
            } elseif ($login_info['role_id'] == 3) {
                $_SESSION["ROLE"] = 'CLIENT';
            } elseif ($login_info['role_id'] == 4) {
                $_SESSION["ROLE"] = 'MODERATOR';
            } else {
                $status = false;
            }
            if ($status) {
                $_SESSION["LOGIN"] = 'YES';
                $_SESSION['EMODEL_LOGIN'] = 'YES';
                $_SESSION["ID"] = $login_info['id'];
                $_SESSION["LOGIN_ID"] = $login_info['id'];
                $_SESSION["NAME"] = $login_info['name'];
                $_SESSION["ROLE_ID"] = $role_id = $login_info['role_id'];
                $_SESSION['success'] = "Welcome to Emodel";
                $profile_id = $login_info['profile_id'];
                $_SESSION['profile_id'] = $login_info['profile_id'];
                $_SESSION['MODEL_MOBILE'] = $login_info['mobile'];
                if ($role_id == 2) {
                    header("location: profile.php?profile_id=$profile_id");
                } else {
                    if ($target_id) {
                        header("location: profile.php?profile_id=$target_id");
                    } else {
                        header("location: index.php");
                    }
                }
            } else {
                $_SESSION['login_error'] = "Something went wrong";
                header('location:login.php');
            }
        } else {
            $_SESSION['login_error'] = "Please enter correct login details";
            header('location:login.php');
        }
    } else {
        header('location:login.php');
    }
} else {
    header("location: index.php");
}
