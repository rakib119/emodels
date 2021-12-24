<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_blog'])) {

    $flag = 0;
    // photo
    if ($_FILES['blog_photo']['error'] > 0) {
        $_SESSION['blog_photo_error'] = "Please correct image";
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
    // blog_description
    if (!$_POST['blog_description']) {
        $_SESSION['blog_description_error'] = "Please enter blog_description";
        $flag = 1;
    } else {
        $blog_description = get_safe_value($_POST['blog_description']);
        $_SESSION['old_blog_description'] = $blog_description;
    }
    if ($flag == 0) {

        $file_name = $_FILES['blog_photo']['name'];
        $new_file_name = generate_file_name($file_name);
        $temp_path =  $_FILES['blog_photo']['tmp_name'];
        $upload_photo = imagecreatefromjpeg($temp_path);
        $new_path = "../media/blog/" . $new_file_name;
        imagejpeg($upload_photo, $new_path, 30);
        $date = date("Y-m-d H:i:s");
        unset($_SESSION['old_title']);
        unset($_SESSION['old_blog_description']);
        if (isset($_POST['submit_blog'])) {

            $column_name = "title,blog_description,blog_photo,created_at";
            $values = "'$title','$blog_description','$new_file_name','$date'";
            if (insert_query("blogs", $column_name, $values)) {
                $_SESSION['success'] = "blog added successfully";
                header('location: blog.php');
            }
        }
    } else {
        header('location: manage_blog.php');
    }
}
if (isset($_POST['edit_blog'])) {

    $id = $_SESSION['edit_blog_id'];
    unset($_SESSION['edit_blog_id']);
    $flag = 0;
    // title
    if (!$_POST['title']) {
        $_SESSION['title_error'] = "Please enter title";
        $flag = 1;
    }
    // news description
    if (!$_POST['blog_description']) {
        $_SESSION['blog_description_error'] = "Please enter blog_description";
        $flag = 1;
    }

    if ($flag == 0) {
        $blog = mysqli_fetch_assoc(select_all("blogs", "*", "WHERE id='$id'"));
        $file_name = $blog['blog_photo'];
        if ($_FILES['blog_photo']['name']) {
            // delete photo
            unlink(site_path() . "media/blog" . "/$file_name");
            // upload new photo
            $file_name = $_FILES['blog_photo']['name'];
            $file_name = generate_file_name($file_name);
            $temp_path =  $_FILES['blog_photo']['tmp_name'];
            $upload_photo = imagecreatefromjpeg($temp_path);
            $new_path = "../media/blog/" . $file_name;
            imagejpeg($upload_photo, $new_path, 30);
        }
        //file uploading
        $title = get_safe_value($_POST['title']);
        $blog_description = get_safe_value($_POST['blog_description']);
        $values = "title = '$title',blog_photo='$file_name',blog_description = '$blog_description'";
        $update = update_data("blogs", "$values", "id='$id'");
        if ($update) {
            $_SESSION['success'] = "blog update successfully";
            header('location: blog.php');
        } else {
            header("location: manage_blog.php?id=$id&&task=edit");
        }
    } else {
        header("location: manage_blog.php?id=$id&&task=edit");
    }
}

if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];

    //update status
    if ($task == "update_status") {
        $update_status = update_status("blogs", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header('location: blog.php');
        }
    }
    if ($task == "delete") {
        $blog = mysqli_fetch_assoc(select_all("blogs", "*", "WHERE id='$id'"));
        $file_name = $blog['blog_photo'];
        //delete specifique row
        unlink(site_path() . "media/blog" . "/$file_name");
        if (delete_row("blogs", "id='$id'")) {
            $_SESSION['success'] = "blog deleted successfully";
            header('location: blog.php');
        }
    }
}
