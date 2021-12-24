<?php
$usermanagement = "";
if (isset($_GET['id']) && isset($_GET['task'])) {
    $photo_id = $_GET['id'];
    require_once('top.inc.php');
?>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.php">Dashboard</a>
            <span class="breadcrumb-item active">Profile Management</span>
        </nav>
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40 ">
                <h1 class="card-body-intro"> <i class="menu-item-icon icon ion-image tx-50"></i> Change Image </h1>
                <div class="form-layout">
                    <form action="submit-photos.php" method="post" enctype="multipart/form-data" data-parsley-validate>
                        <input type="hidden" name="photo_id" value="<?= $photo_id ?>">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-control-label" for="file">Photo: <span class="tx-danger">*</span></label>
                                </div>
                                <label style="width: 100%;">
                                    <input type="file" name="photo" class="form-control">
                                    <?php if (isset($_SESSION['photo_error'])) : ?>
                                        <small class="text-danger"><?= $_SESSION['photo_error'] ?></small>
                                    <?php
                                        unset($_SESSION['photo_error']);
                                    endif;
                                    ?>
                                </label>
                            </div>
                        </div>
                        <div class="form-layout-footer">
                            <button type="submit" name="change_photo" class="btn btn-info mg-r-5">Update</button>
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