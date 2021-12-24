<?php
require_once('inc/functions.inc.php');
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
    <title>Admin Login</title>
    <!-- vendor css -->
    <link href=" lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href=" lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href=" lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href=" css/starlight.css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin <span class="tx-info tx-normal">Login</span></div>
            <div class="tx-center mt-3 mb-4">Enter your mobile and password for login</div>
            <?php if (isset($_SESSION['login_error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <span><?= $_SESSION['login_error'] ?></span>
                    </div>
                </div>
            <?php
            } ?>
            <form action="login-submit.php" method="post">
                <div class="form-group">
                    <input type="hidden" value="<?= $target_id ?>" name="target_id">
                    <div>
                        <label class="form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                    </div>
                    <div class="d-flex">
                        <input type="text" class="form-control" value="+88" style="width: 25%" readonly>
                        <input type="text" name="mobile" required class="form-control <?= (isset($_SESSION['mobile_error'])) ? 'is-invalid' : '' ?>" placeholder="01XXXXXXXXX">
                    </div>
                    <?php if (isset($_SESSION['mobile_error'])) :  ?>
                        <small class="text-danger"><?= $_SESSION['mobile_error'] ?></small>
                    <?php
                        unset($_SESSION['mobile_error']);
                    endif; ?>
                </div>
                <div class="form-group">
                    <div>
                        <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                    </div>
                    <input type="password" name="password" class="form-control <?= (isset($_SESSION['password_error'])) ? 'is-invalid' : '' ?>">
                    <?php if (isset($_SESSION['password_error'])) :  ?>
                        <small class="text-danger"><?= $_SESSION['password_error'] ?></small>
                    <?php
                        unset($_SESSION['password_error']);
                    endif; ?>
                    <!-- <a class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> -->
                </div>
                <button type="submit" class="btn btn-info btn-block">Sign In</button>
            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
    <script src=" lib/jquery/jquery.js"></script>
    <script src=" lib/popper.js/popper.js"></script>
    <script src=" lib/bootstrap/bootstrap.js"></script>
</body>

</html>
<?php
session_unset();
?>