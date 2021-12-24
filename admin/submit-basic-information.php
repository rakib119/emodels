<?php
require_once "inc/functions.inc.php";
// pr($_POST);
// pr($_FILES);
// die();
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
if (isset($_POST['submit_basic_info'])) {
;
    $profile_id = $_POST['profile_id'];
    $age = get_safe_value($_POST['age']);
    $optional_number =$_POST['optional_number'];
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
 

        $column_name = "profile_id,height,weight,waist,hip,age,bust,about,skill,address,maritial_status,chest,skin,education,price,gender,optional_number";
        $values = "'$profile_id','$height','$weight','$waist','$hip','$age','$bust','$about','$skill','$address','$maritial_status','$chest','$skin','$education','$price','$gender','$optional_number'";
        $insert = insert_query("basic_information", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "Basic info added successfully";
            header("Location: basic-information.php?profile_id=$profile_id");
        }
} else {
   header('Location: ' . $_SERVER['HTTP_REFERER']);
 }
