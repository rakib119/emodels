<?php
$usermanagement = "";
require_once('top.inc.php');
// if (!isAdmin() || !ismoderator()) { 
?>
<script>
    // window.location.href="index.php";
</script>
<?php
// }
$task = "add";
$title = "Add User";
$msg = "Add your new user to fill up this form.";
$name = $role_id = $email = $mobile = "";
if (isset($_GET['task']) && $_GET['task'] == "edit") {
    if (!isAdmin()) {
        rejected();
    }
    $task = 'edit';
    $id = $_GET['id'];
    $users = mysqli_fetch_assoc(select_all("users", "*", "WHERE id='$id'"));
    $name = $users['name'];
    $email = $users['email'];
    $mobile = $users['mobile'];
    $role_id = $users['role_id'];
    $title = "Edit Information";
    $msg = "Update User Information.";
} else {
    unset($_SESSION["edit_users_id"]);
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active"><?= $title ?></span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title"><?= $title ?></h6>
            <p class="mg-b-20 mg-sm-b-30"><?= $msg ?></p>
            <div class="form-layout">
                <form action="submit-users.php" method="post">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <?= ($task == 'edit') ? "<input type='hidden' value='$id' name='id'>" : "" ?>
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['name_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_name"]) ? $_SESSION["old_name"] : "$name"; ?>" type="text" name="name" placeholder="Enter name">
                                <?php if (isset($_SESSION['name_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['name_error'] ?></small>
                                <?php
                                    unset($_SESSION['name_error']);
                                endif
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                                <select name='role_id' class="form-control select2 <?= (isset($_SESSION['role_id_error'])) ? 'is-invalid' : '' ?>" data-placeholder="Choose Role">
                                    <option value="">Choose Role</option>
                                    <?php
                                    $condition = "";
                                    if (ismoderator()) {
                                        $condition = "and role_id!=4";
                                    }
                                    $roles =  select_all('user_roles', '*', "WHERE status=1 and role_id!=1 $condition ORDER BY user_role ASC");
                                    foreach ($roles as $role) :
                                    ?>
                                        <option value="<?= $role['role_id'] ?>" <?= ($role_id == $role['role_id']) ? 'selected' : '' ?>> <?= strtoupper($role['user_role']) ?> </option>
                                    <?php
                                        unset($_SESSION['role_id_error']);
                                    endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Mobile: <span class="tx-danger">*</span></label>
                                <input class="form-control <?= (isset($_SESSION['mobile_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_mobile"]) ? $_SESSION["old_mobile"] : "$mobile"; ?>" type="text" name="mobile" placeholder="017XXXXXXXX">
                                <?php if (isset($_SESSION['mobile_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['mobile_error'] ?></small>
                                <?php
                                    unset($_SESSION['mobile_error']);
                                endif
                                ?>
                            </div>
                        </div>
                        <?php if ($task != 'edit') : ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control <?= (isset($_SESSION['password_error'])) ? 'is-invalid' : '' ?>" type="password" name="password" placeholder="Set a password">
                                    <?php if (isset($_SESSION['password_error'])) : ?>
                                        <small class="text-danger"><?= $_SESSION['password_error'] ?></small>
                                    <?php
                                        unset($_SESSION['password_error']);
                                    endif
                                    ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: </label>
                                <input class="form-control <?= (isset($_SESSION['email_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_email"]) ? $_SESSION["old_email"] : "$email"; ?>" type="email" name="email" placeholder="example@gmail.com (Optional)">
                                <?php if (isset($_SESSION['email_error'])) : ?>
                                    <small class="text-danger"><?= $_SESSION['email_error'] ?></small>
                                <?php
                                    unset($_SESSION['email_error']);
                                endif
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" name="<?= ($task == 'edit') ? "edit_users" : "submit_users" ?>" class="btn btn-info mg-r-5"><?= ($task == 'edit') ? "Update" : "Submit" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['old_name']);
    unset($_SESSION['old_role_id']);
    unset($_SESSION['old_email']);
    unset($_SESSION['old_mobile']);
    require_once "footer.inc.php";
    ?>