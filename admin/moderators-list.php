<?php
$usermanagement = "";
require_once('top.inc.php');
if (!isAdmin()) {
    rejected();
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Moderator Management</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Moderator Management</h6>
            <p class="mg-b-20 mg-sm-b-30">Manage Your Moderator</p>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("users", "*", "WHERE role_id=4"));
                if ($row < 1) {
                    echo "<h6 class='text-danger text-center'>* Moderator do not added yet *</h6>";
                } else {
                ?>
                    <table id="myTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("users", "*", "WHERE role_id=4") as $user) :
                                $profile_id = $user['profile_id'];
                                $name = ucfirst($user['name']);
                                $role_id = $user['role_id'];
                                $role = mysqli_fetch_assoc(select_all("user_roles", "*", "WHERE role_id='$role_id '"))['user_role'];
                            ?>
                                <tr>
                                    <td class="text-center"><?= ++$i ?></td>
                                    <td class="text-center"><?= $name ?></td>
                                    <td class="text-center"><?= ($user['email']) ? $user['email'] : "N/A" ?></td>
                                    <td class="text-center"><?= $user['mobile'] ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= ($user['status'] == 1) ? 'info' : 'warning' ?>"><?= ($user['status'] == 1) ? 'Active' : 'Deactive' ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <?php if (isAdmin()) { ?>
                                                    <a class="dropdown-item" target="blank" href="add-user.php?id=<?= $user['id'] ?>&task=edit">Edit</a>
                                                    <a class="dropdown-item" href="submit-users.php?id=<?= $user['id'] ?>&task=update_status"><?= ($user['status'] == 1) ? 'Deactive' : 'Active' ?></a>
                                                    <button value="submit-users.php?id=<?= $user['id'] ?>&task=delete" class=" dropdown-item delete_row btn btn-link">Delete</button>
                                                    <a class="dropdown-item" target="blank" href="reset_password.php?id=<?= base64_encode($user['id']) ?>">Reset Password</a>
                                                <?php } ?>
                                            </div>
                                        </div>
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
    require_once "footer.inc.php"
    ?>