<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_profile_picture'])) {
    // pr($_POST);
    // pr($_FILES);
    // die();
    $profile_id = $_POST['profile_id'];
    $flag = 0;
    // photo
    if ($_FILES['photo']['error'] > 0) {
        $_SESSION['photo_error'] = "Please upload a  photo";
        $flag = 1;
    } else {
        $extension = strtolower(extension($_FILES['photo']['name']));
        if ($extension != "jpg") {
            $_SESSION['photo_error'] = "Please upload .jpg formate image";
            $flag = 1;
        }
    }
    if ($flag == 0) {

        //photo uploading
        $photo_file_name = $_FILES['photo']['name'];
        $new_photo_file_name = generate_file_name($photo_file_name);
        $temp_photo_path =  $_FILES['photo']['tmp_name'];
        $profile_photo = imagecreatefromjpeg($temp_photo_path);
        $new_photo_path = "../media/profile_photo/" . $new_photo_file_name;
        imagejpeg($profile_photo, $new_photo_path, 30);

        $column_name = "profile_id,image";
        $values = "'$profile_id','$new_photo_file_name'";
        $insert = insert_query("profile_photo", $column_name, $values);
        if ($insert) {
            $creator_id = $_SESSION["ID"];
            $_SESSION['success'] = "Photo added successfully";
            header("location: basic-information.php?profile_id=$profile_id#PhotoGallery");
        }
    } else {
        header("Location: add_profile_picture.php?profile_id=$profile_id");
    }
}
// change
if (isset($_POST['change_profile_picture'])) {
    // pr($_POST);
    // pr($_FILES);
    // die();
    $profile_id = $_POST['profile_id'];
    $flag = 0;
    // photo
    if ($_FILES['photo']['error'] > 0) {
        $_SESSION['photo_error'] = "Please upload a  photo";
        $flag = 1;
    } else {
        $extension = strtolower(extension($_FILES['photo']['name']));
        if ($extension != "jpg") {
            $_SESSION['photo_error'] = "Image should be in .jpg formate";
            $flag = 1;
        }
    }
    if ($flag == 0) {
        $old_file_name = mysqli_fetch_assoc(select_all("profile_photo", "*", "WHERE profile_id='$profile_id'"))["image"];
        // delete old file
        $path = site_path() . "media/profile_photo/$old_file_name";
        unlink($path);
        // photo uploading
        $photo_file_name = $_FILES['photo']['name'];
        $new_photo_file_name = generate_file_name($photo_file_name);
        $temp_photo_path =  $_FILES['photo']['tmp_name'];
        $profile_photo = imagecreatefromjpeg($temp_photo_path);
        $new_photo_path = "../media/profile_photo/" . $new_photo_file_name;
        imagejpeg($profile_photo, $new_photo_path, 30);

        if (update_data("profile_photo", "image='$new_photo_file_name'", "profile_id='$profile_id'")) {
            $creator_id = $_SESSION["ID"];
            $_SESSION['success'] = "Profile Picture changed successfully";
            header("location: basic-information.php?profile_id=$profile_id");
        }
    } else {
        header("Location: change_profile_photo.php?profile_id=$profile_id");
    }
}
