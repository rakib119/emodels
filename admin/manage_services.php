<?php

$services = "";
require_once('top.inc.php');
$title = $images = $service_details = '';
if (isset($_GET['task']) && $_GET['task'] == "edit") {
    $photo_req="";
    $id = $_SESSION["edit_service_id"]  = $_GET['id'];
    $services = mysqli_fetch_assoc(select_all("services","*", "WHERE id='$id'"));
    $title = $services['title'];
    $images = $services['service_photo'];
    $service_details = $services['service_details'];
} else {
    unset($_SESSION["edit_service_id"]);
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="service.php">Services</a>
        <span class="breadcrumb-item active">Manage Services</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title"> Manage Services</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your services to fill up this form.</p>
            <div class="form-layout">
                <form action="submit_services.php" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <input type="hidden" value="<?= $id ?>">
                            <div class="form-group">
                                <label class="form-control-label">Service Title: <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['title_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_title"]) ? $_SESSION["old_title"] : "$title"; ?>" type="text" name="title" placeholder="Enter service title">
                                <?php if (isset($_SESSION['title_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['title_error'] ?></small>
                                <?php
                                    unset($_SESSION['title_error']);
                                endif
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label class="form-control-label" for="file">Service Image: <span class="tx-danger"><?=(isset($photo_req))?"":"*"?></span></label>
                            </div>
                                <input type="file" accept=".jpg,.JPG" id="file" name="service_photo" style="width: 100%;" value="<?= $images ?>" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">service Details: <span class="tx-danger">*</span></label>
                                <textarea type="text" name="service_details" class="form-control <?= (isset($_SESSION['service_details_error'])) ? 'is-invalid' : '' ?>" rows="4"><?= isset($_SESSION["old_service_details"]) ? $_SESSION["old_service_details"] : "$service_details" ?></textarea>
                                <?php if (isset($_SESSION['service_details_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['service_details_error'] ?></small>
                                <?php
                                    unset($_SESSION['service_details_error']);
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="<?= isset($_SESSION["edit_service_id"]) ? "edit_service" : "submit_service" ?>" class="btn btn-info mg-r-5"><?= isset($_SESSION["edit_service_id"]) ? "Update" : "Submit" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    unset($_SESSION['old_title']);
    unset($_SESSION['old_service_details']);
    require_once "footer.inc.php";
    ?>