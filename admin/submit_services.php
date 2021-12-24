<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_service'])) {

    $flag = 0;
    // photo
    if ($_FILES['service_photo']['error'] > 0) {
        $_SESSION['service_photo_error'] = "Please correct image";
        $flag = 1;
    }

    // title
    if (!$_POST['title']) {
        $_SESSION['title_error'] = "Please enter title";
        $flag = 1;
    } else {
        $title = get_safe_value($_POST['title']);
        $_SESSION['old_title'] = $title;
    }
    // service_details
    if (!$_POST['service_details']) {
        $_SESSION['service_details_error'] = "Please enter service_details";
        $flag = 1;
    } else {
        $service_details = get_safe_value($_POST['service_details']);
        $_SESSION['old_service_details'] = $service_details;
    }
    if ($flag == 0) {

        $file_name = $_FILES['service_photo']['name'];
        $new_file_name = generate_file_name($file_name);
        $temp_path =  $_FILES['service_photo']['tmp_name'];
        $upload_photo = imagecreatefromjpeg($temp_path);
        $new_path = "../media/services/" . $new_file_name;
        imagejpeg($upload_photo, $new_path, 30);
        $date = date("Y-m-d H:i:s");
        unset($_SESSION['old_title']);
        unset($_SESSION['old_service_details']);
        if (isset($_POST['submit_service'])) {

            $column_name = "title,service_details,service_photo,date";
            $values = "'$title','$service_details','$new_file_name','$date'";
            if (insert_query("services", $column_name, $values)) {
                $_SESSION['success'] = "service added successfully";
                header('location: services.php');
            }
        }
    } else {
        header('location: manage_service.php');
    }
}
if (isset($_POST['edit_service'])) {

    $id = $_SESSION['edit_service_id'];
    unset($_SESSION['edit_service_id']);
    $flag = 0;
    // title
    if (!$_POST['title']) {
        $_SESSION['title_error'] = "Please enter title";
        $flag = 1;
    }
    // news details
    if (!$_POST['service_details']) {
        $_SESSION['service_details_error'] = "Please enter service_details";
        $flag = 1;
    }

    if ($flag == 0) {
        $service = mysqli_fetch_assoc(select_all("services", "*", "WHERE id='$id'"));
        $file_name = $service['service_photo'];
        if ($_FILES['service_photo']['name']) {
            // delete photo
            unlink(site_path() . "media/services" . "/$file_name");
            // upload new photo
            $file_name = $_FILES['service_photo']['name'];
            $file_name = generate_file_name($file_name);
            $temp_path =  $_FILES['service_photo']['tmp_name'];
            $upload_photo = imagecreatefromjpeg($temp_path);
            $new_path = "../media/services/" . $file_name;
            imagejpeg($upload_photo, $new_path, 30);
        }
        //file uploading
        $title = get_safe_value($_POST['title']);
        $service_details = get_safe_value($_POST['service_details']);
        $values = "title = '$title',service_photo='$file_name',service_details = '$service_details'";
        $update = update_data("services", "$values", "id='$id'");
        if ($update) {
            $_SESSION['success'] = "Service update successfully";
            header('location: services.php');
        } else {
            header("location: manage_service.php?id=$id&&task=edit");
        }
    } else {
        header("location: manage_service.php?id=$id&&task=edit");
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];

    //update status
    if ($task == "update_status") {
        $update_status = update_status("services", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: services.php');
        }
    }
    if ($task == "delete") {
        $service = mysqli_fetch_assoc(select_all("services", "*", "WHERE id='$id'"));
        $file_name = $service['service_photo'];
        //delete specifique row
        unlink(site_path() . "media/services" . "/$file_name");
        if (delete_row("services", "id='$id'")) {
            $_SESSION['success'] = "Service deleted successfully";
            header('location: services.php');
        }
    }
}
