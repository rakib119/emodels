<?php
require_once "inc/functions.inc.php";
if (isset($_POST['submit_videos'])) {

    $profile_id = $_POST['profile_id'];
    $thumbnail = $_POST['thumbnail'];
    $flag = 0;
    // video
    if ($_FILES['video']['error'] > 0) {
        $_SESSION['video_error'] = "Please upload a  video";
        $flag = 1;
    } else {
        $extension = strtolower(extension($_FILES['video']['name']));
        if ($extension != "mp4") {
            $_SESSION['video_error'] = "Video should be in .mp4 formate";
            $flag = 1;
        }
    }
    // thumbnail
    if ($_FILES['thumbnail']['error'] > 0) {
        $_SESSION['thumbnail_error'] = "Please upload a thumbnail";
        $flag = 1;
    } else {
        $extension = getimagesize($_FILES['thumbnail']['tmp_name'])['mime'];
        // die();
        if ($extension == "image/jpeg" ||   $extension == "image/png") {
        } else {
            $_SESSION['thumbnail_error'] = "only jpg, jpeg & png is allowed";
            $flag = 1;
        }
    }
    if ($flag == 0) {
        //video uploading
        $video_file_name = $_FILES['video']['name'];
        $new_video_file_name = generate_file_name($video_file_name);
        $temp_video_path =  $_FILES['video']['tmp_name'];
        $new_video_path = "../media/videos/" . $new_video_file_name;
        move_uploaded_file($temp_video_path, $new_video_path);
        //thumbnail uploading
        $thumbnail_file_name = $_FILES['thumbnail']['name'];
        $new_thumbnail_file_name = generate_file_name($thumbnail_file_name);
        $temp_thumbnail_path =  $_FILES['thumbnail']['tmp_name'];
        if ($extension == "image/jpeg") {
            $upload_photo = imagecreatefromjpeg($temp_thumbnail_path);
        }
        if ($extension == "image/png") {
            $upload_photo = imagecreatefrompng($temp_thumbnail_path);
        }
        if ($upload_photo) {
            $new_thumbnail_path = "../media/thumbnails/" . $new_thumbnail_file_name;
            imagejpeg($upload_photo, $new_thumbnail_path, 30);
        } else {
            $_SESSION['error'] = "Some thing went wrong";
            header("location: basic-information.php?profile_id=$profile_id#videoGallery");
        }


        // uploaded at
        $uploaded_at = date('Y-m-d H:i:s');
        $column_name = "profile_id,video,thumbnail,uploaded_at";
        $values = "'$profile_id','$new_video_file_name','$new_thumbnail_file_name','$uploaded_at'";
        $insert = insert_query("videos", $column_name, $values);
        if ($insert) {
            $creator_id = $_SESSION["ID"];
            $_SESSION['success'] = "video added successfully";
            header("location: basic-information.php?profile_id=$profile_id#videoGallery");
        }
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    $profile_id =  mysqli_fetch_assoc(select_all('videos', 'profile_id', "WHERE id=$id"))['profile_id'];
    //delete specifique row
    if ($task == "delete") {
        $videos = mysqli_fetch_assoc(select_all("videos", "*", "WHERE id='$id'"));
        $thumbnail = $videos['thumbnail'];
        $video = $videos['video'];
        unlink(site_path() . "media/thumbnails" . "/$thumbnail");
        unlink(site_path() . "media/videos" . "/$video");
        $delete = delete_row("videos", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "Video Deleted Successfully";
            header("location: basic-information.php?profile_id=$profile_id#videoGallery");
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("videos", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Video status successfully updated";
            header("location: basic-information.php?profile_id=$profile_id#videoGallery");
        }
    }
}
