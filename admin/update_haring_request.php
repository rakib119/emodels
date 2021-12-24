<?php
require_once('inc/functions.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
    die();
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    if ($_GET['task'] == "update_status") {
        if (update_status("hire_info", $_GET['id'])) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: haring-request.php');
        }
    }
} else {
    header('index.php');
}
