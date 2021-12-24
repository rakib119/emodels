<?php
$models = "";
if (!isset($_GET['profile_id'])) {
    header('location: index.php');
} else {
    require_once('top.inc.php');
    if ($_SESSION["ROLE_ID"] == 2) {
        header("location: index.php");
    }
    $profile_id = $_GET['profile_id'];
}

?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="basic-information.php?profile_id=<?=$profile_id?>">Basic Information</a>
        <span class="breadcrumb-item active">Profile Management</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="row">
                <div class="info ">
                    <h6 class="card-body-intro"> Basic Informations</h6>
                </div>
            </div>
            <div class="form-layout">
                <form action="submit-basic-information.php" method="post" enctype="multipart/form-data" data-parsley-validate>
                    <input type="hidden" name="profile_id" value="<?= $profile_id ?>">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Age: </label>
                                <input class="form-control" type="text" name="age">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Optional Number: </label>
                                <input class="form-control" type="text" name="optional_number" placeholder="017********">
                                <?php if (isset($_SESSION['mobile_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['mobile_error'] ?></small>
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
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Maritial Status: </label>
                                <select class="form-control" name="maritial_status">
                                    <option value="">--Choose One--</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Height: </label>
                                <input class="form-control" type="text" name="height">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Weight: </label>
                                <input class="form-control" type="text" name="weight">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Bust: </label>
                                <input class="form-control" type="text" name="bust">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Hip: </label>
                                <input class="form-control" type="text" name="hip">

                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Waist: </label>
                                <input class="form-control " type="text" name="waist">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Chest: </label>
                                <input class="form-control" type="text" name="chest">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Skin: </label>
                                <input class="form-control" type="text" name="skin">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Education: </label>
                                <input class="form-control" type="text" name="education">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">Asking Price: </label>
                                <input class="form-control" type="text" name="price">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">About: </label>
                                <textarea type="text" name="about" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Expertise: <span class="tx-danger">(Must separated by Comma)</span></label>
                                <textarea type="text" name="skill" class="form-control" rows="4"></textarea>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Address: </label>
                                <textarea type="text" name="address" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="submit_basic_info" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>