<?php
$Clients = "";
require_once('top.inc.php');
if (isModel()) {
    rejected();
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Clients Management</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Clients Management</h6>
            <p class="mg-b-20 mg-sm-b-30">Manage your Clients </p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("users", "*"));
                if ($row < 1) {
                    echo "<h6 class='text-danger text-center'>* Information not available *</h6>";
                } else {
                ?>
                    <!-- display responsive nowrap -->
                    <table id="myTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Refrence</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Status</th>
                                <?php if (isAdmin()) { ?>
                                    <th class="text-center">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("users", "*", "WHERE role_id=3 ORDER BY id DESC") as $user) :
                                $profile_id = $user['profile_id'];
                                $name = ucfirst($user['name']);
                                $role_id = $user['role_id'];
                                $role = mysqli_fetch_assoc(select_all("user_roles", "*", "WHERE role_id='$role_id '"))['user_role'];
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$i ?></td>
                                    <td class="text-center"><?= $name ?></td>
                                    <td class="text-center"><?= ($user['reference']) ? $user['reference'] : "N\A" ?></td>
                                    <td class="text-center"><?= (isAdmin()) ? ($user['mobile']) : "01XXXXXXXXX" ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= ($user['status'] == 1) ? 'info' : 'warning' ?>"><?= ($user['status'] == 1) ? 'Active' : 'Deactive' ?></span>
                                    </td>
                                    <?php if (isAdmin()) { ?>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" target="blank" href="add-user.php?id=<?= $user['id'] ?>&task=edit">Edit</a>
                                                    <a class="dropdown-item" href="submit-users.php?id=<?= $user['id'] ?>&task=update_status"><?= ($user['status'] == 1) ? 'Deactive' : 'Active' ?></a>
                                                    <button value="submit-users.php?id=<?= $user['id'] ?>&task=delete" class=" dropdown-item delete_row btn btn-link">Delete</button>
                                                    <a class="dropdown-item" target="blank" href="reset_password.php?id=<?= base64_encode($user['id']) ?>">Reset Password</a>
                                                </div>
                                            </div>
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
    require_once "footer.inc.php"
    ?>