<?php
require_once "inc/functions.inc.php";


if (isset($_POST['submit_basic_info'])) {

    $profile_id = $_POST['profile_id'];
    $age = get_safe_value($_POST['age']);
    $optional_number =get_safe_value($_POST['optional_number']);
    $height = get_safe_value($_POST['height']);
    $weight = get_safe_value($_POST['weight']);
    $waist = get_safe_value($_POST['waist']);
    $hip = get_safe_value($_POST['hip']);
    $bust = get_safe_value($_POST['bust']);
    $about = get_safe_value($_POST['about']);
    $skill = get_safe_value($_POST['skill']);
    $address = get_safe_value($_POST['address']);
    $maritial_status = get_safe_value($_POST['maritial_status']);
    $chest = get_safe_value($_POST['chest']);
    $skin = get_safe_value($_POST['skin']);
    $education = get_safe_value($_POST['education']);
    $price = get_safe_value($_POST['price']);
    $gender = get_safe_value($_POST['gender']);
 
        $values = "height='$height',weight='$weight',waist='$waist',hip='$hip',age='$age',bust='$bust',about='$about',skill='$skill',address='$address',maritial_status='$maritial_status',chest='$chest',skin='$skin',education='$education',price='$price',gender='$gender',optional_number='$optional_number'";
        if (update_data("basic_information", $values, "profile_id='$profile_id'")) {
            $_SESSION['success'] = "Information updated successfully";
             if (isModel()) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header("Location: basic-information.php?profile_id=$profile_id");
            }
        }
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
