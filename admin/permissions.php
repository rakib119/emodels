<?php
$permissions = "";
require_once('top.inc.php');
if ($_SESSION["ROLE_ID"] == 2) {
    header("location: index.php");
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">permissions</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update permissions</h6>
            <p class="mg-b-20 mg-sm-b-20">Add permissionss to fill up this form.</p>
            <form action="submit-users.php" method="post">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                            <select name='role_id' class="form-control select2 <?= (isset($_SESSION['role_id_error'])) ? 'is-invalid' : '' ?>" data-placeholder="Choose Role">
                                <option value="">Choose Role</option>
                                <?php
                                $roles =  select_all('user_roles', '*', 'WHERE status=1 and role_id!=1 ORDER BY user_role ASC');
                                foreach ($roles as $role) :
                                ?>
                                    <option value="<?= $role['role_id'] ?>"> <?= strtoupper($role['user_role']) ?> </option>
                                <?php
                                    unset($_SESSION['role_id_error']);
                                endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="ckbox">
                            <input type="checkbox"><span>Checkbox Unchecked</span>
                        </label>
                    </div>
                </div>
                <div class="form-layout-footer">
                    <button type="submit" name="<?= isset($_SESSION["edit_users_id"]) ? "edit_users" : "submit_users" ?>" class="btn btn-info mg-r-5"><?= isset($_SESSION["edit_users_id"]) ? "Update" : "Submit" ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">permissions</h6>
            <p class="mg-b-20 mg-sm-b-30">Add permissionss to fill up this form.</p>
            <div class="form-layout">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th class="text-center" width="3%" scope="col">No</th>
                            <th class="text-center" width="10%" scope="col">Role</th>
                            <th class="text-center" width="75%" scope="col">Permissions</th>
                            <th class="text-center" width="5%" scope="col">Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <form action="">
                                <td class="text-center" scope="col"></td>
                                <td class="text-center" scope="col"> </td>
                                <td class="text-center" scope="col"></td>
                                <td class="text-center" scope="col">
                                    <a class="text-white" href="submit_permissions.php?id=<?= $permissions['id'] ?>&&task=update_status">
                                        <button class="btn btn-warning  btn-block mg-b-10">Update</button>
                                    </a>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
                <a href="manage_permissions.php">
                    <button class="btn btn-primary mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add permissions</button>
                </a>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.inc.php";
    ?>