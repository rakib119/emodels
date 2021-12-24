<?php
require_once('admin/inc/functions.inc.php');
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
    <title>Models Login</title>
    <!-- Starlight CSS -->
    <link rel="stylesheet" href=" admin/css/starlight.css">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Model's <span class="tx-info tx-normal">Login</span></div>
            <div class="tx-center mg-b-60">Enter your mobile and password for login</div>
            
            <form action="model_login_submit.php" method="post">
                <div class="form-group">
                    <div>
                        <label class="form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                    </div>
                    <input type="text" name="mobile" class="form-control <?= (isset($_SESSION['mobile_error'])) ? 'is-invalid' : '' ?>" placeholder="+880">
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
                </div>
                <button type="submit" name="model_login" class="btn btn-info btn-block">Sign In</button>
            </form>
        </div>
    </div>
    <script src=" admin/lib/bootstrap/bootstrap.js"></script>
</body>

</html>