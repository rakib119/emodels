<?php
require_once('top.inc.php');
if (!isset($_GET['id'])) {
    rejected();
}
if (!isAdmin()) {
    rejected();
}
$id = $_GET['id'];

?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Reset Password</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row justify-content-center">
            <div class="card pd-20 pd-sm-40">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Reset <span class="tx-info tx-normal">Password</span></div>
                <div class="tx-center mt-3 mb-4">For reset password please set a new password</div>
                <div class="form-layout">
                    <form action="submit_reset_password.php" method="post">
                        <div class="row mg-b-25">
                            <div class="col-lg-12 mb-3">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div>
                                    <label class="form-control-label" for="file">Set Password <span class="tx-danger">*</span></label>
                                </div>
                                <input type="text" autocomplete="off" required name="password" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" name="reset_password" class="btn btn-block btn-info mg-r-5">Update</button>
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