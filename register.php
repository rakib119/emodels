<?php
require_once("admin/inc/functions.inc.php");
if (isset($_SESSION["EMODEL_LOGIN"])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>emodels Register</title>
    <!-- Starlight CSS -->
    <link rel="stylesheet" href=" admin/css/starlight.css">
</head>

<body>
    <?php
    // print_array($_SESSION);
    ?>
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

        <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse"><?= ucfirst(single_value("author"))  ?> <span class="tx-info tx-normal">Register</span></div>
            <div class="tx-center mb-2">Give your information to register as user</div>
            <div class="tx-center mb-5">Back to <a href="index.php">Home</a></div>

            <?php if (isset($_SESSION['reg_error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><?= $_SESSION['reg_error'] ?></h6>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h6><?= single_value("register_message")  ?></h6>
                </div>
            <?php endif ?>
            <form action="register_submit.php" method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control <?= (isset($_SESSION['name_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_name"]) ? $_SESSION["old_name"] : "" ?>" placeholder="Enter your Name">
                    <?php if (isset($_SESSION['name_error'])) : ?>
                        <p class="text-danger"><?= $_SESSION['name_error'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <input type="text" name="reference" class="form-control <?= (isset($_SESSION['reference_error'])) ? 'is-invalid' : '' ?>" value="<?= isset($_SESSION["old_reference"]) ? $_SESSION["old_reference"] : "" ?>" placeholder="Reference (if have any)">
                </div>
                <div class="form-group">
                    <div class="d-flex">
                        <input type="text" class="form-control" value="+88" style="width: 25%" readonly>
                        <input type="text" name="mobile" class="form-control <?= (isset($_SESSION['mobile_error'])) ? 'is-invalid' : '' ?>" placeholder="017XXXXXXXX" value="<?= isset($_SESSION["old_mobile"]) ? $_SESSION["old_mobile"] : "" ?>">
                    </div>

                    <?php if (isset($_SESSION['mobile_error'])) : ?>
                        <p class="text-danger"><?= $_SESSION['mobile_error'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control <?= (isset($_SESSION['password_error'])) ? 'is-invalid' : '' ?>" placeholder="Enter your password">
                    <?php if (isset($_SESSION['password_error'])) : ?>
                        <p class="text-danger"><?= $_SESSION['password_error'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control <?= (isset($_SESSION['confirm_password_error'])) ? 'is-invalid' : '' ?>" placeholder="Re-type your password">
                    <?php if (isset($_SESSION['confirm_password_error'])) : ?>
                        <p class="text-danger"><?= $_SESSION['confirm_password_error'] ?></p>
                    <?php endif ?>
                </div>
                <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
                <button type="submit" name="submit" class="btn btn-info btn-block">Sign Up</button>
            </form>
        </div>
    </div>
    <script src=" lib/bootstrap/bootstrap.js"></script>
</body>

</html>
<?php
session_unset();
?>