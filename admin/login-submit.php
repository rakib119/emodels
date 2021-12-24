<?php
require_once("inc/functions.inc.php");
$flag = 0;
if (!$_POST['mobile']) {
    $flag = 1;
    $_SESSION['mobile_error'] = "Please enter your mobile number";
}
if (!$_POST['password']) {
    $flag = 1;
    $_SESSION['password_error'] = "Please enter your Password";
}
// session_unset();
if ($flag != 1) {
    $mobile = valid_phone_number($_POST['mobile']);
    $password = password_format($_POST['password']);
    $sql = select_all('users', '*', "WHERE mobile='$mobile' AND password='$password' AND status=1 AND role_id!=2 AND role_id!=3");
    $row = mysqli_num_rows($sql);
    if ($row == 1) {
        $login_info = mysqli_fetch_assoc($sql);
        $_SESSION["LOGIN"] = 'YES';
        $_SESSION['EMODEL_LOGIN'] = 'YES';
        $_SESSION["ID"] = $login_info['id'];
        $_SESSION["LOGIN_ID"] = $login_info['id'];
        $_SESSION["NAME"] = $login_info['name'];
        $_SESSION["ROLE_ID"] = $role_id = $login_info['role_id'];
        $_SESSION['success'] = "login successfull";
        if ($role_id == 1) {
            $_SESSION["ROLE"] = 'ADMIN';
            header('location: index.php');
        } elseif ($role_id == 4) {
            $_SESSION["ROLE"] = 'MODERATOR';
            header('location: index.php');
        }
    } else {
        $_SESSION['login_error'] = "Please enter correct login details";
        header('location: login.php');
    }
} else {
    header('location: login.php');
}
