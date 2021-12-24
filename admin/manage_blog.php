<?php

$blog = "";
require_once('top.inc.php');
$title = $images = $blog_description = '';
if (isset($_GET['task']) && $_GET['task'] == "edit") {
    $photo_req="";
    $id = $_SESSION["edit_blog_id"]  = $_GET['id'];
    $blog = mysqli_fetch_assoc(select_all("blogs","*", "WHERE id='$id'"));
    $title = $blog['title'];
    $images = $blog['blog_photo'];
    $blog_description = $blog['blog_description'];
} else {
    unset($_SESSION["edit_blog_id"]);
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="blog.php">blog</a>
        <span class="breadcrumb-item active">Manage blog</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title"> Manage blog</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your blog to fill up this form.</p>
            <div class="form-layout">
                <form action="submit_blog.php" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <input type="hidden" value="<?= $id ?>">
                            <div class="form-group">
                                <label class="form-control-label">blog Title: <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['title_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_title"]) ? $_SESSION["old_title"] : "$title"; ?>" type="text" name="title" placeholder="Enter blog title">
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
                                <label class="form-control-label" for="file">Blog Image: <span class="tx-danger"><?=(isset($photo_req))?"":"*"?></span></label>
                            </div>
                                <input type="file" accept=".jpg,.JPG" id="file" name="blog_photo" style="width: 100%;" value="<?= $images ?>" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">blog description: <span class="tx-danger">*</span></label>
                                <textarea type="text" name="blog_description" class="form-control <?= (isset($_SESSION['blog_description_error'])) ? 'is-invalid' : '' ?>" rows="4"><?= isset($_SESSION["old_blog_description"]) ? $_SESSION["old_blog_description"] : "$blog_description" ?></textarea>
                                <?php if (isset($_SESSION['blog_description_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['blog_description_error'] ?></small>
                                <?php
                                    unset($_SESSION['blog_description_error']);
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="<?= isset($_SESSION["edit_blog_id"]) ? "edit_blog" : "submit_blog" ?>" class="btn btn-info mg-r-5"><?= isset($_SESSION["edit_blog_id"]) ? "Update" : "Submit" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    unset($_SESSION['old_title']);
    unset($_SESSION['old_blog_description']);
    require_once "footer.inc.php";
    ?>