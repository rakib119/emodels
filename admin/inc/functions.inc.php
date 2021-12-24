<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
// require_once "connection.inc.php";
function db_connect()
{
    return $con = mysqli_connect("localhost", "emodejfy", "jOArmN5Vpitr", "emodejfy_emodel");
}

function site_path()
{
    define('ROOTPATH', dirname(dirname(__DIR__)) . "/");
    return ROOTPATH;
}
// count 
function custom_count($table_name, $column_name, $conditions = "")
{
    if ($conditions) {
        $conditions =  "where $conditions";
    }
    $count_query = mysqli_query(db_connect(), "SELECT COUNT($column_name) AS total FROM $table_name $conditions");
    $number = mysqli_fetch_assoc($count_query)['total'];
    return $number;
}
// insert query
function insert_query($table_name, $column_name, $values)
{
    // echo $query = "INSERT into $table_name ($column_name) VALUES($values)";
    // die();
    $insert = mysqli_query(db_connect(), "INSERT into $table_name ($column_name) VALUES($values)");
    return $insert;
}
// data_exist 
function data_exist($table, $value)
{
    $mobile_cheak = mysqli_num_rows(mysqli_query(db_connect(), "SELECT * FROM $table WHERE $value"));
    return $mobile_cheak;
}
// SELECT query
function select_all($table_name, $column, $conditions = "")
{
    // echo  "SELECT $column FROM $table_name $conditions";
    // die();
    $select_query = mysqli_query(db_connect(), "SELECT $column FROM $table_name $conditions");
    return $select_query;
}

// SELECT row
function select_row($table_name, $condition)
{
    $select_query = mysqli_query(db_connect(), "SELECT * FROM $table_name WHERE $condition");
    return $select_query;
}
//single value
function single_value($field_name)
{
    $single_value = mysqli_fetch_assoc(select_all("general_settings", "*", "WHERE field_name='$field_name' and status=1"));
    return $single_value['value'];
}
// delete row      
function delete_row($table_name, $condition, $file_name = '', $folder = '')
{
    $res = 1;
    if ($file_name != '' && $folder != '') {
        $res = unlink(site_path() . "media/$folder" . "/$file_name");
    }
    if ($res == 1) {
        $select_query = mysqli_query(db_connect(), "DELETE FROM $table_name WHERE $condition");
        return $select_query;
    }
}


// update status
function update_status($table_name, $id)
{
    $fetch_status = mysqli_fetch_assoc(select_all($table_name, '*', "WHERE id ='$id'"));
    $old_status = $fetch_status['status'];
    if ($old_status == 1) {
        $update_status = 0;
    } else {
        $update_status = 1;
    }
    $update_status_querry = mysqli_query(db_connect(), "UPDATE $table_name SET status='$update_status' WHERE id='$id'");
    return $update_status_querry;
}

// update data
function update_data($table_name, $value, $condition)
{
    // echo "UPDATE $table_name SET $value where $condition";
    // die();
    $update = mysqli_query(db_connect(), "UPDATE $table_name SET $value where $condition");
    return $update;
}

// update file 

function update_file($table_name, $file_id, $imageFileLocation, $column_name, $input_field_name)
{
    //fetch old file name
    $old_file_name = mysqli_fetch_assoc(select_row($table_name, "id=$file_id"))["$column_name"];
    // delete old file
    $path = site_path() . "$imageFileLocation/$old_file_name";
    unlink($path);
    // upload new file
    $file_name = $_FILES[$input_field_name]['name'];
    $new_file_name = generate_file_name($file_name);
    $temp_path =  $_FILES[$input_field_name]['tmp_name'];
    $new_path = "../" . $imageFileLocation . $new_file_name;
    move_uploaded_file($temp_path, $new_path);
    $updateStatus = update_data($table_name, $column_name = '$new_file_name', "id=$file_id");
    return $updateStatus;
    //upload new file

    // echo $file_name = $_FILES[$input_field_name]['name'];
    // echo "<br>";
    // echo $new_file_name = generate_file_name($file_name);
    // echo "<br>";
    // $temp_path =  $_FILES[$input_field_name]['tmp_name'];

    // $new_path = $path . $new_file_name;
    // echo $new_path . "new path </br>";
    // $status = move_uploaded_file($temp_path, $new_path);
    // echo $status . "new path </br>";
    // if ($status) {
    //     $upload_status = update_data($table_name, $column_name = $new_file_name, "WHERE id=$file_id");
    // } else {
    //     // echo "something wrong";
    //     // die();
    // }
    // $new_thumbnail_file_name = generate_file_name($file_name);
    // $temp_thumbnail_path =  $_FILES['thumbnail']['tmp_name'];
    // $upload_status = move_uploaded_file($temp_path, $path);
    // return $upload_status;
}

function pr($str)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
function get_safe_value($str)
{
    if ($str != '') {
        $str = trim($str);
        $str = htmlspecialchars($str);
        return mysqli_real_escape_string(db_connect(), $str);
    }
}
function name_format($str)
{
    if ($str != '') {
        $str = get_safe_value($str);
        $str = strtolower($str);
        $str = ucwords($str);
        return mysqli_real_escape_string(db_connect(), $str);
    }
}
function email_format($str)
{
    if ($str != '') {
        $str = get_safe_value($str);
        $str = strtolower($str);
        return mysqli_real_escape_string(db_connect(), $str);
    }
}
function message_format($str)
{
    if ($str != '') {
        $str = get_safe_value($str);
        $str = ucfirst($str);
        return mysqli_real_escape_string(db_connect(), $str);
    }
}
// phone number Validation
function valid_phone_number($str)
{
    if ($str != '') {
        $str = get_safe_value($str);
        $numaric = is_numeric($str);
        $len = strlen($str);
        $pos_0 = strpos($str, "0");
        $pos_1 = strpos($str, "1");
        $pos_2_3 = strpos($str, "3");
        $pos_2_4 = strpos($str, "4");
        $pos_2_5 = strpos($str, "5");
        $pos_2_6 = strpos($str, "6");
        $pos_2_7 = strpos($str, "7");
        $pos_2_8 = strpos($str, "8");
        $pos_2_9 = strpos($str, "9");
        if ($numaric == true && $len == 11 && $pos_0 == 0 && $pos_1 == 1) {

            if (
                $pos_2_3 == 2 || $pos_2_4 == 2 || $pos_2_5 == 2 || $pos_2_6 == 2 ||
                $pos_2_7 == 2 || $pos_2_8 == 2 || $pos_2_9 == 2
            ) {
                return mysqli_real_escape_string(db_connect(), $str);
            } else {
                $str = "";
                return mysqli_real_escape_string(db_connect(), $str);
            }
        } else {
            $str = "";
            return mysqli_real_escape_string(db_connect(), $str);
        }
    }
}
//password formate
function password_format($str)
{
    if ($str != "") {
        $str = get_safe_value($str);
        $str = sha1($str);
        $str = md5($str);
        return mysqli_real_escape_string(db_connect(), $str);
    }
}
// cheak login or not
function is_login()
{
    if (!isset($_SESSION["EMODEL_LOGIN"]) && !$_SESSION["EMODEL_LOGIN"] == 'YES') {
        header("location: login.php");
    }
}
//file extension
function extension($file_name)
{
    $after_explode = explode(".", $file_name);
    $extension = end($after_explode);
    return $extension;
}
// genarate unique file name 
function generate_file_name($file_name)
{
    $extension = extension($file_name);
    $new_file_name = date("Y-m-d_H-i-s") . rand(111111111, 9999999999) . "." . $extension;
    return $new_file_name;
}
//random string
function random_string($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// unique name
function unique_name($name, $id)
{
    $profile_name = strtolower($name);
    if (strpos($profile_name, ' ')) {
        $after_explode = explode(" ", $profile_name);
        $profile_name = $after_explode[0] . "-" . $after_explode[1];
    }

    $new_name = $profile_name . '-' . random_string('2') . rand(11, 99) . $id;
    get_safe_value($new_name);
    return $new_name;
}
// Send otp
function sendOtp($mobile_number, $otp)
{
    $url = "http://66.45.237.70/api.php";
    $number = $mobile_number;
    $text = "Your verification code is : " . $otp;
    $data = array(
        'username' => "bdcareer",
        'password' => "DSPAKW34",
        'number' => "$number",
        'message' => "$text"
    );
    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    $p = explode("|", $smsresult);
    $sendstatus = $p[0];
    return $sendstatus;
}
// isAdmin
function isAdmin()
{
    if ($_SESSION["ROLE_ID"] == 1) {
        return true;
    } else {
        return false;
    }
} // isModel
function isModel()
{
    if ($_SESSION["ROLE_ID"] == 2) {
        return true;
    } else {
        return false;
    }
} // isClient
function isClient()
{
    if ($_SESSION["ROLE_ID"] == 3) {
        return true;
    } else {
        return false;
    }
} // isModel
function ismoderator()
{
    if ($_SESSION["ROLE_ID"] == 4) {
        return true;
    } else {
        return false;
    }
}
function notAllowed()
{
    if (isClient()) {
?>
        <script>
            window.location.href = '../index.php';
        </script>
    <?php

    }
}
// rejected
function rejected()
{ ?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
// unique_name("rakibhasan", 7);
// password_format("Raha7t&*3");
