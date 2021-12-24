<?php
require_once("inc/functions.inc.php");
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
// pr($_POST);
// die();
if (isset($_POST['submit_users'])) {
    $name = name_format($_POST['name']);
    $role_id = get_safe_value($_POST['role_id']);
    $email = email_format($_POST['email']);
    $mobile = valid_phone_number($_POST['mobile']);
    $password = password_format($_POST['password']);
    $error_flag = 0;
    // name
    if (!$name) {
        $error_flag = 1;
        $_SESSION['name_error'] = "Please enter user's name";
    } else {
        $_SESSION['old_name'] =  $name;
    }
    // roll
    if (!$role_id) {
        $error_flag = 1;
        $_SESSION['role_id_error'] = "Please select user role";
    }
    // mobile
    if (!$mobile) {
        $error_flag = 1;
        $_SESSION['mobile_error'] = "Please enter user's mobile";
    } else {
        $check_mobile = mysqli_query(db_connect(), "SELECT mobile FROM users WHERE mobile='$mobile'");
        $mobile_exits = mysqli_num_rows($check_mobile);
        if ($mobile_exits > 0) {
            $error_flag = 1;
            $_SESSION['mobile_error'] = "Mobile already exist..";
        } else {
            $_SESSION['old_mobile'] =  $mobile;
        }
    }
    // password
    if (!$password) {
        $error_flag = 1;
        $_SESSION['password_error'] = "Please enter a password";
    }
    if ($error_flag == 1) {
        header("location: add-user.php");
    } else {
        unset($_SESSION['old_name']);
        unset($_SESSION['old_email']);
        unset($_SESSION['old_mobile']);
        $column_name = "name,role_id,email,mobile,password,status";
        $values = "'$name','$role_id','$email','$mobile','$password','1'";
        $sql = insert_query("users", $column_name, $values);
        if ($sql) {
            if ($role_id == 2) {
                $user_info = mysqli_fetch_assoc(select_all('users', '*', "WHERE mobile='$mobile'"));
                $id = $user_info['id'];
                $name = $user_info['name'];
                $profile_id = unique_name($name, $id);
                update_data('users', "profile_id='$profile_id'", "id='$id'");
                $_SESSION['success'] = "New Model added successfully";
                header('location: models-list.php');
            } elseif ($role_id == 3) {
                $_SESSION['success'] = "New Client added successfully";
                header('location: clients-list.php');
            } else {
                $_SESSION['success'] = "New moderator added successfully";
                header('location: moderators-list.php');
            }
        } else {
            $_SESSION['reg_error'] = "Faild to Register";
            header("location: add-user.php");
        }
    }
}
// Edit User Information
if (isset($_POST['edit_users'])) {
    if (!isAdmin()) {
        rejected();
        exit();
    }
    $id = get_safe_value($_POST['id']);
    $name = name_format($_POST['name']);
    $role_id = get_safe_value($_POST['role_id']);
    $email = email_format($_POST['email']);
    $mobile = valid_phone_number($_POST['mobile']);
    $error_flag = 0;
    // name
    if (!$name) {
        $error_flag = 1;
        $_SESSION['name_error'] = "Please enter user's name";
    }
    // roll
    if (!$role_id) {
        $error_flag = 1;
        $_SESSION['role_id_error'] = "Please select user role";
    }
    // mobile
    if (!$mobile) {
        $error_flag = 1;
        $_SESSION['mobile_error'] = "Please enter user's mobile";
    }
    if ($error_flag == 1) {
        header("location: add-user.php?id=$id&task=edit");
    } else {
        $condition = "id=$id";
        $values = "name='$name',role_id='$role_id',email='$email',mobile='$mobile'";
        $sql = update_data("users", $values, $condition);
        if ($sql) {
            $_SESSION['success'] = "Information updated successfully";
            if ($role_id == 2) {
                header('location: models-list.php');
            } elseif ($role_id == 3) {
                header('location: clients-list.php');
            } else {
                header('location: moderators-list.php');
            }
        } else {
            $_SESSION['error'] = "Not update";
            header("location: add-user.php?id=$id&task=edit");
        }
    }
}
if (isset($_GET['id']) && $_GET['task']) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    if ($task == "delete") {
        $delete = delete_row("users", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "User deleted successfully";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("users", "$id");
        $info = mysqli_fetch_assoc(select_all('users', '*', "WHERE id='$id'"));

        if ($info['role_id'] == 3 && $info['status'] == 1) {
            // send Approve message to client
            $message = single_value("client_approval_message");
            $url = "http://66.45.237.70/api.php";
            $text = $message;
            $mobile =   $info['mobile'];
            $data = array(
                'username' => "bdcareer",
                'password' => "DSPAKW34",
                'number' => "$mobile",
                'message' => "$text"
            );
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|", $smsresult);
            $sendstatus = $p[0];
        }
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
