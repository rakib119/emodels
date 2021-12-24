<?php
$photos = "";

require_once('top.inc.php');
if (!isModel()) { ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
// upload photos
if (isset($_POST['submit_photos'])) {

    $profile_id = $_SESSION['profile_id'];
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
        }

        $column_name = "profile_id,photo,status";
        $values = "'$profile_id','$new_photo_file_name',0";
        $insert = insert_query("photos", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "Photo added successfully";
        }
    }
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Add Information</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row">
            <div class="card pd-20 pd-sm-40 col-md-12 col-sm-12 col-lg-12">
                <h2 class="card-body-intro"><i class="menu-item-icon icon ion-image tx-50"></i> Upload Image </h2>
                <div class="row">
                    <div class="form-layout mt-2 col-md-6 col-sm-6 col-lg-6">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-control-label" for="file">Photo: <span class="tx-danger">*</span></label>
                                    </div>
                                    <label style="width: 100%;">
                                        <input type="file" name="photo" accept=".jpg,.JPG,.png,.PNG,.jpeg,.JPEG" class="form-control">
                                        <?php if (isset($_SESSION['photo_error'])) : ?>
                                            <small class="text-danger"><?= $_SESSION['photo_error'] ?></small>
                                        <?php
                                            unset($_SESSION['photo_error']);
                                        endif;
                                        ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-layout-footer text-center">
                                <button type="submit" id="submit_photos" name="submit_photos" class="btn btn-info mg-r-5">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sl-pagebody" id="PhotoGallery">
        <div class="card pd-20 pd-sm-40" id="photoList">
            <h3 class="card-body-title">PHOTOS</h3>
            <p class="mg-b-20 mg-sm-b-30">See Your Photos </p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("photos", "*", "WHERE profile_id='$profile_id'"));
                if ($row < 1) {
                    echo "<h2 class='text-danger text-center'>* No photos added yet *</h2>";
                } else {
                ?>
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">photo</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("photos", "*", "WHERE profile_id='$profile_id' ORDER BY id  DESC") as $photo) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td>
                                        <img src="../media/photos/<?= $photo['photo'] ?>" width="100" height='70'>
                                    </td>
                                    <td scope="col">
                                        <span class="badge  <?= ($photo['status'] == 1) ? 'badge-primary' : 'badge-warning' ?> "><?= ($photo['status'] == 1) ? 'Active' : 'Deactive' ?> </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>