<?php
$info = "";
require_once('top.inc.php');
if (!isModel()) { ?>
    <script>
        window.location.href="index.php";
    </script>   
<?php
}
// $age = $waist = $hip = $height = $weight = $bust = $about = $address = "";
$profile_id = $_SESSION['profile_id'];
$model_info = mysqli_fetch_assoc(select_all('basic_information', '*', "where profile_id ='$profile_id' "));


?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">General Information</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="row">
                <div class="info ">
                    <h6 class="card-body-intro"> Basic Informations</h6>
                </div>
            </div>
            <div class="form-layout mt-3">
                <form action="submit-update-profile.php" method="post" enctype="multipart/form-data" data-parsley-validate>
                    <input type="hidden" name="profile_id" value="<?= $profile_id ?>">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Name: </label>
                                <input class="form-control" value="<?= $_SESSION['NAME'] ?>" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Age: </label>
                                <input class="form-control" value="<?= $model_info['age'] ?>" type="text" name="age">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Mobile Number: </label>
                                <input class="form-control" value="<?= $_SESSION['MODEL_MOBILE'] ?>" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Optional Number: </label>
                                <input class="form-control <?= (isset($_SESSION['mobile_error']) ? "is-invalid" : "")  ?>" value="<?= $model_info['optional_number'] ?>" type="text" name="optional_number" placeholder="017********">
                                <?php if (isset($_SESSION['mobile_error'])) : ?>
                                    <h6 class="text-danger"><?= $_SESSION['mobile_error'] ?></h6>
                                <?php
                                    unset($_SESSION['mobile_error']);
                                endif
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Gender: </label>
                                <select class="form-control" name="gender">
                                    <option value="">--Choose One--</option>
                                    <option value="male" <?= ($model_info['gender'] == "male") ? "selected" : "" ?>>Male</option>
                                    <option value="female" <?= ($model_info['gender'] == "female") ? "selected" : "" ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Maritial Status: </label>
                                <select class="form-control" name="maritial_status">
                                    <option value="">--Choose One--</option>
                                    <option value="married" <?= ($model_info['maritial_status'] == "married") ? "selected" : "" ?>>Married</option>
                                    <option value="unmarried" <?= ($model_info['maritial_status'] == "unmarried") ? "selected" : "" ?>>Unmarried</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Height: </label>
                                <input class="form-control" value="<?= $model_info['height'] ?>" type="text" name="height">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Weight: </label>
                                <input class="form-control" value="<?= $model_info['weight'] ?>" type="text" name="weight">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Bust: </label>
                                <input class="form-control" value="<?= $model_info['bust'] ?>" type="text" name="bust">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Hip: </label>
                                <input class="form-control" value="<?= $model_info['hip'] ?>" type="text" name="hip">

                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Waist: </label>
                                <input class="form-control " value="<?= $model_info['waist'] ?>" type="text" name="waist">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Chest: </label>
                                <input class="form-control" value="<?= $model_info['chest'] ?>" type="text" name="chest">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Skin: </label>
                                <input class="form-control" value="<?= $model_info['skin'] ?>" type="text" name="skin">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Education: </label>
                                <input class="form-control" value="<?= $model_info['education'] ?>" type="text" name="education">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Asking Price: </label>
                                <input class="form-control" value="<?= $model_info['price'] ?>" type="text" name="price" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">About: </label>
                                <textarea type="text" name="about" class="form-control" rows="4"><?= $model_info['about'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Expertise: <span class="tx-danger">(Must separated by Comma)</span></label>
                                <textarea type="text" name="skill" class="form-control" rows="4"><?= $model_info['skill'] ?></textarea>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Address: </label>
                                <textarea type="text" name="address" class="form-control" rows="3"><?= $model_info['address'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="submit_basic_info" class="btn btn-info mg-r-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>