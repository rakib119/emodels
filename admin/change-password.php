<?php
require_once('top.inc.php');
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Change Password</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row justify-content-center">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-intro text-center">Change Password</h6>
                <p class="mg-b-20 mg-sm-b-30">Give your old password and set a new password</p>
                <div class="form-layout">
                    <form action="change-password-submit.php" method="post" enctype="multipart/form-data">
                        <div class="row mg-b-25">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-control-label" for="file">Old Password <span class="tx-danger">*</span></label>
                                </div>
                                <input type="text" name="old_password" class="form-control">
                                <?php if (isset($_SESSION['old_password_error'])) : ?>
                                    <h6 class="text-danger"><?= $_SESSION['old_password_error'] ?></h6>
                                <?php
                                    unset($_SESSION['old_password_error']);
                                endif;
                                ?>

                                <div>
                                    <label class="form-control-label" for="file">New Password <span class="tx-danger">*</span></label>
                                </div>
                                <input type="text" name="new_password" class="form-control">
                                <?php if (isset($_SESSION['new_password_error'])) : ?>
                                    <h6 class="text-danger"><?= $_SESSION['new_password_error'] ?></h6>
                                <?php
                                    unset($_SESSION['new_password_error']);
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="form-layout-footer text-center">
                            <button type="submit" name="change_password" class="btn btn-info mg-r-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>