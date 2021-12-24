<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_photos'])) {
    $profile_id = $_POST['profile_id'];
    $flag = 0;
    // photo
    if ($_FILES['photo']['error'] > 0) {
        $_SESSION['photo_error'] = "Please upload a  photo";
        $flag = 1;
    } else {
        $extension = getimagesize($_FILES['photo']['tmp_name'])['mime'];
        // die();
        if ($extension == "image/jpeg" ||   $extension == "image/png") {
        } else {
            $_SESSION['photo_error'] = "only jpg, jpeg & png is allowed";
            $flag = 1;
        }
    }

    if ($flag == 0) {

        //photo uploading
        $photo_file_name = $_FILES['photo']['name'];
        $new_photo_file_name = generate_file_name($photo_file_name);
        $temp_photo_path =  $_FILES['photo']['tmp_name'];
        if ($extension == "image/jpeg") {
            $upload_photo = imagecreatefromjpeg($temp_photo_path);
        }
        if ($extension == "image/png") {
            $upload_photo = imagecreatefrompng($temp_photo_path);
        }
        if (isset($upload_photo)) {
            $new_photo_path = "../media/photos/" . $new_photo_file_name;
            imagejpeg($upload_photo, $new_photo_path, 40);
        } else {
            $_SESSION['error'] = "Some thing went wrong";
            header("location: basic-information.php?profile_id=$profile_id#PhotoGallery");
        }


        $column_name = "profile_id,photo";
        $values = "'$profile_id','$new_photo_file_name'";
        $insert = insert_query("photos", $column_name, $values);
        if ($insert) {
            $creator_id = $_SESSION["ID"];
            $_SESSION['success'] = "Photo added successfully";
            header("location: basic-information.php?profile_id=$profile_id#PhotoGallery");
        }
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    $profile_id =  mysqli_fetch_assoc(select_all('photos', 'profile_id', "WHERE id=$id"))['profile_id'];
    //delete specifique row
    if ($task == "delete") {
        $photos = mysqli_fetch_assoc(select_all("photos", "*", "WHERE id='$id'"));
        $photo = $photos['photo'];
        unlink(site_path() . "media/photos" . "/$photo");
        $delete = delete_row("photos", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "Photo deleted successfully";
            header("location: basic-information.php?profile_id=$profile_id#PhotoGallery");
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("photos", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Photo status successfully updated";
            header("location: basic-information.php?profile_id=$profile_id#PhotoGallery");
        }
    }
}
