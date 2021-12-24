<?php
$slider = "";
require_once('top.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
$intro = $slider_photo = $message = '';
if (isset($_GET['task']) && $_GET['task'] == "edit") {
    $photo_id = $_GET['id'];
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="slider.php">slider</a>
        <span class="breadcrumb-item active">Manage Slider</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-intro"> Manage slider</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your working slider to fill up this form.</p>
            <div class="form-layout">
                <form action="submit-slider.php" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <input type="hidden" name="photo_id" value="<?= $photo_id ?>">
                            <div>
                                <label class="form-control-label" for="file">Slider Photo: <span class="tx-danger">*</span></label>
                            </div>

                            <input type="file" id="file" name="slider_image" accept="image/jpg" class="form-control">
                            <?php if (isset($_SESSION['slider_image_error'])) : ?>
                                <h6 class="text-danger"><?= $_SESSION['slider_image_error'] ?></h6>
                            <?php
                                unset($_SESSION['slider_image_error']);
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="change_slider" class="btn btn-info mg-r-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>
    <!-- <script>
        var _URL = window.URL || window.webkitURL;
        $("#file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function(ee) {
                    var width = this.width;
                    var height = this.height;
                    $("#width").html(width);
                    $("#height").html(height);
                    if (width != 1600 || height != 560) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please give proper size image',
                            textColor: '#3085d6',
                            text: '1600px * 560px',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })

                    }
                }
                img.src = _URL.createObjectURL(file);
            }
        });
    </script> -->