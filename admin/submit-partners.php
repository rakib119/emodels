<?php
require_once "inc/functions.inc.php";

if (isset($_POST['submit_partners'])) { 
    
    $flag = 0;
    $profile_id = $_POST['profile_id'];
   $partner_name =get_safe_value($_POST['partner_name']) ;
    if ($flag == 0) {
        $column_name = "partner_name,profile_id";
        $values = "'$partner_name','$profile_id'";
        $insert = insert_query("partners", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "partners added successfully";
            header("location: basic-information.php?profile_id=$profile_id");
        }
    } else {
        header("location: partners.php?profile_id=$profile_id");
    }
}
if (isset($_POST['edit_partners'])) {
    $flag = 0;
    $id = $_POST['id'];
    $partner_name =get_safe_value($_POST['partner_name']) ;
    if ($id !="" && $partner_name !="") {
       $value = "partner_name='$partner_name'";
       $condition = "id='$id'";
        $update = update_data("partners", "$value", "$condition");
        if ($update) {
            $_SESSION['success'] = "partners successfully updated";
            header("location: edit_partners.php?id=$id&task=edit");
        }else {
            header("location: edit_partners.php?id=$id&task=edit");
        }
    } else {
        header("location: index.php");
    }
}
if (isset($_GET['id']) && isset($_GET['task'])) {
    $id = $_GET["id"];
    $task = $_GET["task"];
    $profile_id =  mysqli_fetch_assoc(select_all('partners', 'profile_id', "WHERE id=$id"))['profile_id'];
    //delete specifique row
    if ($task == "delete") {
        $delete = delete_row("partners", "id='$id'");
        if ($delete) {
            $_SESSION['success'] = "Information deleted successfully";
            header("location: basic-information.php?profile_id=$profile_id#partnerList");
        }
    }
    //update status
    if ($task == "update_status") {
        $update_status = update_status("partners", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
            header("location: basic-information.php?profile_id=$profile_id#partnerList");
        }
    }
}
