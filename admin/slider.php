<?php
$slider = "";
require_once('top.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Slider</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-intro">Slider</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your working Slider to fill up this form.</p>
            <div class="form-layout">
                <form action="submit-slider.php" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div>
                                <label class="form-control-label" for="file">Slider Photo: <span class="tx-danger"> * </span></label>
                            </div>
                            <input type="file" id="file" accept=".jpg,.jpeg" name="slider_image" accept="image/jpg" class="form-control">
                            <?php if (isset($_SESSION['slider_image_error'])) : ?>
                                <h6 class="text-danger"><?= $_SESSION['slider_image_error'] ?></h6>
                            <?php
                                unset($_SESSION['slider_image_error']);
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="submit_slider" class="btn btn-info mg-r-5">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-intro">Slider</h6>
            <p class="mg-b-20 mg-sm-b-30">Add your working Slider to fill up this form.</p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("slider", "*"));
                if ($row < 1) {
                    echo "<h6 class='text-danger text-center'>* Slider does not added yet *</h6>";
                } else {
                ?>
                    <table class="table  table-responsive table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Slider Photo</th>
                                <th width="10%" scope="col"></th>
                                <th width="10%" scope="col">Actions</th>
                                <?php if (isAdmin()) { ?>
                                    <th width="10%" scope="col"></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("slider", "*") as $slider) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td><img src="../media/slider/<?= $slider['slider_image'] ?>" width="50"> </td>
                                    <td scope="col">
                                        <a class="text-white" href="submit-slider.php?id=<?= $slider['id'] ?>&task=update_status">
                                            <button class="btn <?= ($slider['status'] == 1) ? 'btn-teal active' : 'btn-warning' ?>  btn-block mg-b-10"><?= ($slider['status'] == 1) ? 'Active' : 'Deactive' ?></button>
                                        </a>
                                    </td>
                                    <td scope="col">
                                        <a class="text-white" href="manage-slider.php?id=<?= $slider['id'] ?>&task=edit">
                                            <button class="btn btn-primary btn-block mg-b-10"><i class="fa fa-edit mg-r-10"></i> Edit
                                            </button>
                                        </a>
                                    </td>
                                    <?php if (isAdmin()) { ?>
                                        <td scope="col">
                                            <button value="submit-slider.php?id=<?= $slider['id'] ?>&&task=delete" class="btn btn-danger delete_row btn-block mg-b-10"> <i class="fa fa-trash mg-r-10"></i> Delete</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>
    <!-- image size checking -->
    <script>
        // var _URL = window.URL || window.webkitURL;
        // $("#file").change(function(e) {
        //     var file, img;

        //     if ((file = this.files[0])) {
        //         img = new Image();
        //         img.onload = function(ee) {
        //             var width = this.width;
        //             var height = this.height;
        //             $("#width").html(width);
        //             $("#height").html(height);
        //             if (width != 1600 || height != 560) {
        //                 Swal.fire({
        //                     icon: 'warning',
        //                     title: 'Please give proper size image',
        //                     textColor: '#3085d6',
        //                     text: '1600px * 560px',
        //                     confirmButtonColor: '#3085d6',
        //                     confirmButtonText: 'ok'
        //                 }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         location.reload();
        //                     }
        //                 })

        //             }
        //         }
        //         img.src = _URL.createObjectURL(file);
        //     }
        // });
    </script>