<?php
require_once("admin/inc/functions.inc.php");
$flag = 0;
if (isset($_POST['send_otp'])) {
    $mobile =  $_POST['mobile'];
    $flag = 0;

    if (!$_POST['mobile']) {
        $flag = 1;
        $_SESSION['mobile_error'] = "Please enter your mobile number";
    } else {
        $mobile = valid_phone_number($_POST['mobile']);
        if (!$mobile) {
            $_SESSION['mobile_error'] = "Please enter valid number";
            $flag = 1;
        }
    }
    if (!$_POST['company_name']) {
        $flag = 1;
        $_SESSION['company_name_error'] = "Please enter your company name";
    } else {
        $company_name = get_safe_value($_POST['company_name']);
    }
    $target = $_POST['target'];
    if ($flag != 1) {
        $_SESSION['mobile'] = $mobile;
        $_SESSION['company_name'] = $company_name;
        $_SESSION['otp'] = $otp = rand(1111, 9999);
        // send otp
        $url = "http://66.45.237.70/api.php";
        $text = "Your emodels.xyz OTP code is " . $otp;
        $mobile =   $_POST['mobile'];
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
        if ($sendstatus) {
            $_SESSION['send_otp_status'] = true;
            if ($target) {
                header("location: login.php?target=$target");
            } else {
                header("location: login.php");
            }
        }
    }else{
        header("location: login.php");
    }
}
if (isset($_POST['verify_you'])) {
    if (!$_POST['otp']) {
        $_SESSION['otp_error'] = "Please enter verification code";
        header('location: login.php');
    } else {
        $otp = get_safe_value($_POST['otp']);
        $profile_id = $_POST['target'];

        if ($otp == $_SESSION['otp']) {
            unset($_SESSION['otp']);
            unset($_SESSION['send_otp_status']);
            $mobile = $_SESSION['mobile'];
            $company_name = $_SESSION['company_name'];
            $role_id = 3;
            $created_at = date("Y-m-d H:i:s");
            $insert = insert_query('users', "name,mobile,role_id,created_at,status", "'$company_name','$mobile','$role_id','$created_at','1'");

            if ($insert) {
                $_SESSION["EMODEL_LOGIN"] = 'YES';
                $_SESSION["user_role"] = 'client';
                $_SESSION["NAME"] = $company_name;
                $_SESSION["mobile"] = $mobile;
                $_SESSION['success'] = "Welcome to Emodel";
                if ($profile_id) {
                    header("location: profile.php?profile_id=$profile_id");
                } else {
                    header("location: index.php");
                }
            }
        } else {
            $_SESSION['otp_error'] = "otp not matched";
            header('location: login.php');
        }
    }
}
