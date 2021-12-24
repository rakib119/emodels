<?php
require_once "inc/functions.inc.php";
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
if (isset($_POST['submit_slider'])) {
    $flag = 0;
    // pr($_FILES);
    // die();
    // photo
    if ($_FILES['slider_image']['error'] > 0) {
        $_SESSION['slider_image_error'] = "Please correct image";
        $flag = 1;
    }
    if ($flag == 0) {
        //file uploading
        $file_name = $_FILES['slider_image']['name'];
        $new_file_name = generate_file_name($file_name);
        $temp_path =  $_FILES['slider_image']['tmp_name'];
        $upload_photo = imagecreatefromjpeg($temp_path);
        $new_path = "../media/slider/" . $new_file_name;
        imagejpeg($upload_photo, $new_path, 30);
        $column_name = "slider_image";
        $values = "'$new_file_name'";
        $insert = insert_query("slider", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "slider added successfully";
            header('location: slider.php');
        }
    } else {
        $_SESSION['slider_image_error'] = "Please upload a image";
        header('location:slider.php');
    }
}
if (isset($_POST['change_slider'])) {

    $id = $_POST['photo_id'];
    $flag = 0;
    if ($_FILES['slider_image']['error'] > 0) {
        $_SESSION['slider_image_error'] = "Please correct image";
        $flag = 1;
    } else {
        $extension = strtolower(extension($_FILES['slider_image']['name']));
        if ($extension != "jpg") {
            $_SESSION['slider_image_error'] = "Image should be in .jpg formate";
            $flag = 1;
        }
    }
    if ($flag == 0) {
        if ($_FILES['slider_image']['name']) {
            $old_file_name = mysqli_fetch_assoc(select_row("slider", "id=$id"))["slider_image"];
            // delete old file
            $path = site_path() . "media/slider/$old_file_name";
            unlink($path);
            //thumbnail uploading
            //file uploading
            $file_name = $_FILES['slider_image']['name'];
            $new_file_name = generate_file_name($file_name);
            $temp_path =  $_FILES['slider_image']['tmp_name'];
            $upload_photo = imagecreatefromjpeg($temp_path);
            $new_path = "../media/slider/" . $new_file_name;
            imagejpeg($upload_photo, $new_path, 30);

            $sliderupdate = update_data('slider', "slider_image='$new_file_name'", "id=$id");
        }
        if ($sliderupdate) {
            $_SESSION['success'] = "Update successfully";
            header('location: slider.php');
        } else {
            header("location: manage-slider.php?id=$id&&task=edit");
        }
    } else {
        header("location: manage-slider.php?id=$id&&task=edit");
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];

    //delete specifique row
    if ($task == "delete") {
        $slider = mysqli_fetch_assoc(select_all("slider", "WHERE id='$id'"));
        $file_name = $slider['slider_image'];
        $delete = delete_row("slider", "id='$id'", $file_name, "slider");
        if ($delete) {
            $_SESSION['success'] = "One row deleted successfully";
            header('location: slider.php');
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("slider", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: slider.php');
        }
    }
}
