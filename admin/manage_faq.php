<?php

$faq = "";
require_once('top.inc.php');
$question = $answere = '';
if (isset($_GET['task']) && $_GET['task'] == "edit") {
    $photo_req = "";
    $id = $_SESSION["edit_faq_id"]  = $_GET['id'];
    $faq = mysqli_fetch_assoc(select_all("faq", "*", "WHERE id='$id'"));
    $question = $faq['question'];
    $answere = $faq['answere'];
} else {
    unset($_SESSION["edit_faq_id"]);
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="faq.php">Faq</a>
        <span class="breadcrumb-item active">Manage Faq</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title"> Manage Faq</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your Faq to fill up this form.</p>
            <div class="form-layout">
                <form action="submit_faq.php" method="post">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <input type="hidden" value="<?= $id ?>">
                            <div class="form-group">
                                <label class="form-control-label">Question: <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['question_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_faq"]) ? $_SESSION["old_faq"] : "$question"; ?>" type="text" name="question">
                                <?php if (isset($_SESSION['question_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['question_error'] ?></small>
                                <?php
                                    unset($_SESSION['question_error']);
                                endif
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Answere: <span class="tx-danger">*</span></label>
                                <textarea type="text" name="answere" class="form-control <?= (isset($_SESSION['answere_error'])) ? 'is-invalid' : '' ?>" rows="4"><?= isset($_SESSION["old_answere"]) ? $_SESSION["old_answere"] : "$answere" ?></textarea>
                                <?php if (isset($_SESSION['answere_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['answere_error'] ?></small>
                                <?php
                                    unset($_SESSION['answere_error']);
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="<?= isset($_SESSION["edit_faq_id"]) ? "edit_faq" : "submit_faq" ?>" class="btn btn-info mg-r-5"><?= isset($_SESSION["edit_faq_id"]) ? "Update" : "Submit" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    unset($_SESSION['old_faq']);
    unset($_SESSION['old_answere']);
    require_once "footer.inc.php";
    ?>