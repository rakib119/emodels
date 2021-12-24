<?php
$videos = "";
require_once('top.inc.php');
if (!isModel()) { ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
if (isset($_POST['submit_videos'])) {
    $profile_id = $_SESSION['profile_id'];
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
        }

        // uploaded at
        $uploaded_at = date('Y-m-d H:i:s');
        $column_name = "profile_id,video,thumbnail,uploaded_at,status";
        $values = "'$profile_id','$new_video_file_name','$new_thumbnail_file_name','$uploaded_at',0";
        $insert = insert_query("videos", $column_name, $values);
        if ($insert) {
            $creator_id = $_SESSION["ID"];
            $_SESSION['success'] = "video added successfully";
        }
    }
}
$profile_id = $_SESSION['profile_id'];
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active"> Videos</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row">
            <div class="card pd-20 pd-sm-40 col-md-12 col-sm-12 col-lg-12">
                <h2 class="card-body-intro"><i class="menu-item-icon  icon ion-ios-videocam tx-50"></i> Upload Video </h2>
                <div class="row">
                    <div class="form-layout  mt-2 col-lg-6  col-md-6 ">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <div class="row mg-b-25 ">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-control-label" for="file">Thumbnail: <span class="tx-danger">*</span></label>
                                    </div>
                                    <label style="width: 100%;">
                                        <input type="file" name="thumbnail" accept=".jpg,.JPG,.png,.PNG,.jpeg,.JPEG" class="form-control">
                                        <?php if (isset($_SESSION['thumbnail_error'])) : ?>
                                            <h6 class="text-danger"><?= $_SESSION['thumbnail_error'] ?></h6>
                                        <?php
                                            unset($_SESSION['thumbnail_error']);
                                        endif;
                                        ?>
                                    </label>
                                </div>
                            </div>
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-control-label" for="file">Video: <span class="tx-warning">*</span></label>
                                    </div>
                                    <label style="width: 100%;">
                                        <input type="file" name="video" accept=".mp4" class="form-control">
                                        <?php if (isset($_SESSION['video_error'])) : ?>
                                            <h6 class="text-danger"><?= $_SESSION['video_error'] ?></h6>
                                        <?php
                                            unset($_SESSION['video_error']);
                                        endif;
                                        ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-layout-footer text-center">
                                <button type="submit" name="submit_videos" class="btn btn-info mg-r-5">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40" id="videoGallery">
            <h3 class="card-body-title">Videos</h3>
            <p class="mg-b-20 mg-sm-b-30">See Your Videos </p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("videos", "*", "WHERE profile_id='$profile_id'"));
                if ($row < 1) {
                    echo "<h2 class='text-danger text-center'>* No video added yet *</h2>";
                } else {
                ?>
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Video</th>
                                <th width="10%" scope="col">Actions</th>
                                <th width="10%" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("videos", "*", "WHERE profile_id='$profile_id' ORDER BY id  DESC") as $video) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td>
                                        <img src="../media/thumbnails/<?= $video['thumbnail'] ?>" width="50" height='50'>
                                    </td>
                                    <td scope="col">
                                        <span class="badge  <?= ($video['status'] == 1) ? 'badge-primary' : 'badge-warning' ?> "><?= ($video['status'] == 1) ? 'Active' : 'Deactive' ?> </span>
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