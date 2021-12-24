<?php
$usermanagement = "";
if (isset($_GET['id']) && isset($_GET['task'])) {
    $video_id = $_GET['id'];
    require_once('top.inc.php');
?>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.php">Dashboard</a>
            <span class="breadcrumb-item active">Profile Management</span>
        </nav>
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h1 class="card-body-intro"> <i class="menu-item-icon icon  ion-ios-videocam tx-50"></i> Change Video </h1>
                <div class="form-layout">
                    <form action="submit-videos.php" method="post" enctype="multipart/form-data" data-parsley-validate>
                        <input type="hidden" name="video_id" value="<?= $video_id ?>">
                        <div class="row mg-b-25 justify-content-center">
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-control-label" for="file">Thumbnail: <span class="tx-warning">(218px x 114px)</span></label>
                                </div>
                                <label style="width: 100%;">
                                    <input type="file" id="fileUpload" name="thumbnail" class="form-control">
                                    <?php if (isset($_SESSION['thumbnail_error'])) : ?>
                                        <small class="text-danger"><?= $_SESSION['thumbnail_error'] ?></small>
                                    <?php
                                        unset($_SESSION['thumbnail_error']);
                                    endif;
                                    ?>
                                </label>
                            </div>

                        </div>
                        <div class="row mg-b-25 justify-content-center">
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-control-label" for="file">Video: <span class="tx-warning">(218px x 114px)</span></label>
                                </div>
                                <label style="width: 100%;">
                                    <input type="file" id="fileUpload" name="video" class="form-control">
                                    <?php if (isset($_SESSION['video_error'])) : ?>
                                        <small class="text-danger"><?= $_SESSION['video_error'] ?></small>
                                    <?php
                                        unset($_SESSION['video_error']);
                                    endif;
                                    ?>
                                </label>
                            </div>

                        </div>
                        <div class="form-layout-footer text-center">
                            <button type="submit" name="change_video" class="btn btn-info mg-r-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        require_once "footer.inc.php";
        ?>
    <?php
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
    ?>