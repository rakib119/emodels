<?php
$general_settings = "";
require_once('top.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
if (isset($_GET['task']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $general_settings = mysqli_fetch_assoc(select_all("general_settings", '*', "WHERE id='$id'"));
    $value = $general_settings['value'];
} else {
    unset($_SESSION["edit_general_settings_id"]);
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">general_settings</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">General_settings</h6>
            <p class="mg-b-20 mg-sm-b-30">Add general_settingss to fill up this form.</p>

            <div class="form-layout">
                <form action="submit_general_settings.php" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="hidden" value="<?= $id ?>" name="id">
                                <label class="form-control-label">VALUE <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['value_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_value"]) ? $_SESSION["old_value"] : "$value" ?>" type="text" name="value">
                                <?php if (isset($_SESSION['value_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['value_error'] ?></small>
                                <?php
                                    unset($_SESSION['value_error']);
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="edit_general_settings" class="btn btn-info mg-r-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['old_value']);
    require_once "footer.inc.php";
    ?>