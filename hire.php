<?php
require_once "admin/inc/functions.inc.php";
if (!isset($_GET['pid'])) {
    header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $company_name = $_SESSION['NAME'];
    $user_id = $_SESSION["ID"];
    $mobile = $_SESSION['mobile'];
    $created_at = date("Y-m-d h:i:s");
    $haring_profile = $_GET['pid'];
    $insert  = insert_query("hire_info", "user_id,company_name,mobile,haring_profile,created_at", "'$user_id','$company_name','$mobile','$haring_profile','$created_at'");
    if ($insert) {
        $_SESSION['hire_msg'] = "We will contact you soon";
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
