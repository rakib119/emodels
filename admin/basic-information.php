<?php
$usermanagement = "";
require_once('top.inc.php');
if (isModel()) {
    rejected();
}
if (isClient()) {
    rejected();
}
if (isset($_GET['profile_id'])) {
    $profile_id = $_GET['profile_id'];
    $profile_photo = mysqli_fetch_assoc(select_all('profile_photo', "*", "where profile_id='$profile_id '"))['image'];
    $model_info = mysqli_fetch_assoc(select_all('users', '*', "where profile_id ='$profile_id' "));
    $profile_id = $model_info['profile_id'];
    $upload_status = False;
    if (mysqli_num_rows(select_all("basic_information", "*", "WHERE profile_id='$profile_id'"))) {
        $upload_status = True;
    }
?>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.php">Dashboard</a>
            <span class="breadcrumb-item active">Profile Management</span>
        </nav>
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="row">
                    <div class="info ">
                        <h6 class="card-body-intro"> Basic Information of <span class="text-danger"> <?= $model_info['name']; ?></span> </h6>
                    </div>

                </div>
                <table class="table mt-5 ">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>profile</th>
                            <th>Mobile</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $model_info['name']; ?>
                            </td>
                            <td>
                                <?php
                                if ($profile_photo) { ?>
                                    <img width="50" src="../media/profile_photo/<?= $profile_photo ?>">
                                <?php
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </td>
                            <td>
                                <?= $model_info['mobile'] ?>
                            </td>
                            <td scope="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-teal dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php if ($upload_status) { ?>
                                            <a href="update-profile.php?profile_id=<?= $profile_id ?>" class="dropdown-item" href="#">Update Information</a>
                                        <?php } else { ?>
                                            <a href="add_info.php?profile_id=<?= $profile_id ?>" class="dropdown-item" href="#">Add Information</a>
                                        <?php } ?>

                                        <?php
                                        if ($profile_photo) { ?>
                                            <a href="change_profile_photo.php?profile_id=<?= $profile_id ?>" class="dropdown-item">Change Profile Picture</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="add_profile_picture.php?profile_id=<?= $profile_id ?>" class="dropdown-item">Add Profile Picture</a>
                                        <?php
                                        }
                                        ?>
                                        <a href="add_photos.php?profile_id=<?= $profile_id ?>" class="dropdown-item" href="#">Add Photo</a>
                                        <a href="add_videos.php?profile_id=<?= $profile_id ?>" class="dropdown-item" href="#">Add Video</a>
                                        <a href="partners.php?profile_id=<?= $profile_id ?>" class="dropdown-item" href="#">Add Company logo</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="sl-pagebody" id="PhotoGallery">
            <div class="card pd-20 pd-sm-40" id="photoList">
                <h3 class="card-body-title">PHOTOS</h3>
                <p class="mg-b-20 mg-sm-b-30">See Your Photos </p>
                <div class="form-layout">
                    <?php
                    $row = mysqli_num_rows(select_all("photos", "*", "WHERE profile_id='$profile_id'"));
                    if ($row < 1) {
                        echo "<h6 class='text-danger text-center'>* No photos added yet *</h6>";
                    } else {
                    ?>
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">photo</th>
                                    <th width="10%" scope="col">Actions</th>
                                    <?php if (isAdmin()) { ?>
                                        <th width="10%" scope="col"></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach (select_all("photos", "*", "WHERE profile_id='$profile_id'") as $photo) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= ++$i ?></th>
                                        <td>
                                            <img src="../media/photos/<?= $photo['photo'] ?>" width="50" height='70'>
                                        </td>
                                        <td scope="col">
                                            <a class="text-white" href="submit-photos.php?id=<?= $photo['id'] ?>&task=update_status">
                                                <button class="btn <?= ($photo['status'] == 1) ? 'btn-teal active' : 'btn-warning' ?>  btn-block mg-b-10"><?= ($photo['status'] == 1) ? 'Active' : 'Deactive' ?></button>
                                            </a>
                                        </td>
                                        <?php if (isAdmin()) { ?>
                                            <td scope="col">
                                                <button value="submit-photos.php?id=<?= $photo['id'] ?>&task=delete" class="btn delete_row btn-danger btn-block mg-b-10"> <i class="fa fa-trash mg-r-10"></i> Delete</button>
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
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40" id="videoGallery">
                <h3 class="card-body-title">Videos</h3>
                <p class="mg-b-20 mg-sm-b-30">See Your Videos </p>
                <div class="form-layout">
                    <?php
                    $row = mysqli_num_rows(select_all("videos", "*", "WHERE profile_id='$profile_id'"));
                    if ($row < 1) {
                        echo "<h6 class='text-danger text-center'>* No video added yet *</h6>";
                    } else {
                    ?>
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Video</th>
                                    <th width="10%" scope="col">Actions</th>

                                    <?php if (isAdmin()) { ?>
                                        <th width="10%" scope="col"></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach (select_all("videos", "*", "WHERE profile_id='$profile_id'") as $video) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= ++$i ?></th>
                                        <td>
                                            <img src="../media/thumbnails/<?= $video['thumbnail'] ?>" width="50" height='50'>
                                        </td>
                                        <td scope="col">
                                            <a class="text-white" href="submit-videos.php?id=<?= $video['id'] ?>&task=update_status">
                                                <button class="btn <?= ($video['status'] == 1) ? 'btn-teal active' : 'btn-warning' ?>  btn-block mg-b-10"><?= ($video['status'] == 1) ? 'Active' : 'Deactive' ?></button>
                                            </a>
                                        </td>
                                        <?php if (isAdmin()) { ?>
                                            <td scope="col">
                                                <button value="submit-videos.php?id=<?= $video['id'] ?>&task=delete" class="btn delete_row btn-danger btn-block mg-b-10"> <i class="fa fa-trash mg-r-10"></i> Delete</button>
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
        <div class="sl-pagebody" id="partnerList">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-partner_name">Partners list</h6>

                <div class="form-layout">
                    <?php
                    $row = mysqli_num_rows(select_all("partners", "*", "where profile_id='$profile_id'"));
                    if ($row < 1) {
                        echo "<h6 class='text-danger text-center'>* No partners added yet *</h6>";
                    } else {
                    ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">partner_name</th>
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
                                foreach (select_all("partners", "*", "where profile_id='$profile_id'") as $partners) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= ++$i ?></th>
                                        <td><?= $partners['partner_name'] ?></td>

                                        <td scope="col">
                                            <a class="text-white" href="submit-partners.php?id=<?= $partners['id'] ?>&task=update_status">
                                                <button class="btn <?= ($partners['status'] == 1) ? 'btn-teal active' : 'btn-warning' ?>  btn-block mg-b-10"><?= ($partners['status'] == 1) ? 'Active' : 'Deactive' ?></button>
                                            </a>
                                        </td>
                                        <td scope="col">
                                            <a class="text-white" href="edit_partners.php?id=<?= $partners['id'] ?>&task=edit">
                                                <button class="btn btn-primary btn-block mg-b-10"><i class="fa fa-edit mg-r-10"></i> Edit
                                                </button>
                                            </a>
                                        </td>
                                        <?php if (isAdmin()) { ?>
                                            <td scope="col">
                                                <button value="submit-partners.php?id=<?= $partners['id'] ?>&task=delete" class="btn btn-danger delete_row btn-block mg-b-10"> <i class="fa fa-trash mg-r-10"></i> Delete</button>
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
    <?php
    header('Location: index.php');
} ?>