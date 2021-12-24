<?php
require_once('top.inc.php');

if (isModel()) { ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}
if (isset($_GET['task']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $partners = mysqli_fetch_assoc(select_all("partners", '*', "WHERE id='$id'"));
    if (!$partners) {
    ?>
        <script>
            window.location.href = "index.php";
        </script>
<?php
    }
    $partner_name = $partners['partner_name'];
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Edit Partners</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-partner_name"> Edit model's previous working company</h6>
            <div class="form-layout">
                <form action="submit-partners.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <d class="row mg-b-25">
                        <div class="col-lg-6">
                            <div>
                                <label class="form-control-label" for="file">Company Name: <span class="tx-danger">*</span></label>
                            </div>
                            <input type="text" value="<?= $partner_name ?>" name="partner_name" class="form-control" required>
                        </div>
            </div>
            <div class="form-layout-footer ml-3 mt-3">
                <button type="submit" name="edit_partners" class="btn btn-info mg-r-5">update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once "footer.inc.php";
?>