<?php
$models = "";
if (!isset($_GET['profile_id'])) {
    header('location: index.php');
} else {
    $profile_id = $_GET['profile_id'];
}
require_once('top.inc.php');
if (isModel()) {
    rejected();
}
if (isClient()) {
    rejected();
}

?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="basic-information.php?profile_id=<?= $profile_id ?>">Basic Information</a>
        <span class="breadcrumb-item active">Add Information</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row">
            <div class="card pd-20 pd-sm-40 col-md-12 col-sm-12 col-lg-12">
                <h2 class="card-body-intro"><i class="menu-item-icon icon ion-image tx-50"></i> Upload Image </h2>
                <div class="row">
                    <div class="form-layout mt-2 col-md-6 col-sm-6 col-lg-6">
                        <form action="submit-photos.php" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <input type="hidden" name="profile_id" value="<?= $profile_id ?>">
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
    <?php
    require_once "footer.inc.php";
    ?>