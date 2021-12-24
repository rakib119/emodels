<?php
$haring = "";
require_once('top.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
if (isset($GET['id']) && isset($GET['task'])) {
    if ($task == "update_status") {
        $update_status = update_status("hire_info", "$id");
        if ($update_status) {
            $_SESSION['success'] = "Status successfully updated";
        }
    }
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Haring Request</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Haring Request</h6>
            <p class="mg-b-20 mg-sm-b-30">Haring List</p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("hire_info", "*"));
                if ($row < 1) {
                    echo "<h6 class='text-danger text-center'>*No request found *</h6>";
                } else {
                ?>
                    <table id="myTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Haring Profile</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("hire_info", "*") as $hire_info) :
                                $profile_id = $hire_info['haring_profile'];
                                $mobile = $hire_info['mobile'];
                                $company_name = ucfirst($hire_info['company_name']);
                                $created_at = $hire_info['created_at'];
                                $profile_name = mysqli_fetch_assoc(select_all('users', '*', "Where profile_id='$profile_id' order by status DESC"))['name'];
                            ?>
                                <tr class="<?= ($hire_info['status'] == 1) ? '' : 'table-dark' ?>">
                                    <td class="text-center"><?= ++$i ?></td>
                                    <td class="text-center"><?= $company_name ?></td>
                                    <td class="text-center"><?= (isAdmin()) ? $mobile : "01XXXXXXXXX" ?></td>
                                    <td class="text-center text-white">
                                        <a href="../profile.php?profile_id=<?= $profile_id ?>"><?= $profile_name ?></a>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= ($hire_info['status'] == 1) ? 'info' : 'warning' ?>"><?= ($hire_info['status'] == 1) ? 'Read' : 'Unread' ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isAdmin()) { ?>
                                            <a class="text-white" href="update_haring_request.php?id=<?= $hire_info['id'] ?>&task=update_status">
                                                <button class="btn <?= ($hire_info['status'] == 0) ? 'btn-teal active' : 'btn-warning' ?>  "><?= ($hire_info['status'] == 0) ? 'Read' : 'Unread' ?></button>
                                            </a>
                                        <?php } else { ?>
                                            <button class="btn <?= ($hire_info['status'] == 0) ? 'btn-teal active' : 'btn-warning' ?>  "><?= ($hire_info['status'] == 0) ? 'Read' : 'Unread' ?></button>
                                        <?php } ?>
                                    </td>
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