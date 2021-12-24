<?php
if (!isset($_GET['profile_id'])) {
    header('location: index.php');
}
require_once('top.inc.php');
if (isModel()) { ?>
    <script>
        window.location.href="index.php";
    </script>   
<?php
}
$partners = "";
$profile_id = $_GET['profile_id'];


?>
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">partners</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-partner_name"> Add partners</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your partners to fill up this form.</p>

            <div class="form-layout">
                <form action="submit-partners.php" method="post" enctype="multipart/form-data">
                    <d class="row mg-b-25">
                        <input type="hidden" name="profile_id" value="<?= $profile_id ?>">
                        <div class="col-lg-6">
                            <div>
                                <label class="form-control-label" for="file">Company Name: <span class="tx-danger">*</span></label>
                            </div>
                            <input type="text" name="partner_name" class="form-control" required>
                            <?php if (isset($_SESSION['partner_name_error'])) : ?>
                                <small class="text-danger"><?= $_SESSION['partner_name_error'] ?></small>
                            <?php
                                unset($_SESSION['partner_name_error']);
                             endif
                            ?>
                        </div>
                     </div>
            <div class="form-layout-footer ml-3 mt-3">
                <button type="submit" name="submit_partners" class="btn btn-info mg-r-5">Submit</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>