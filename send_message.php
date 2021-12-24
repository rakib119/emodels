<?php
require_once "admin/inc/functions.inc.php";
if (isset($_POST['submit'])) {
    // print_r($_POST);
    $name = name_format($_POST['name']);
    $mobile = valid_phone_number($_POST['mobile']);
    $message = get_safe_value($_POST['message']);

    if (!$name || !$mobile || !$message) {
        $_SESSION['error'] = "All field are required";
        header('location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        $column_name = "name,mobile,message";
        $values = "'$name','$mobile','$message'";
        $insert = insert_query("contact", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "Message sent successfully";
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
