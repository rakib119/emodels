<?php
require_once('admin/inc/functions.inc.php');
if (isset($_SESSION['EMODEL_LOGIN'])) {
    header("location: " . $_SERVER['HTTP_REFERER']);
}else{
   if (isset($_GET['target'])) {
        $target_id=$_GET['target'];
    }else{
       $target_id="";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Login</title>
    <!-- vendor css -->
    <link href=" admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href=" admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href=" admin/lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href=" admin/css/starlight.css">
</head>
<body>
    <?php if (!isset($_SESSION['send_otp_status'])) { ?>
        <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse"> Login</div>
                <div class="tx-center mg-b-60">Enter your <span class="tx-info">Company </span> name and <span class="tx-info">Mobile</span>
                    number to login</div>
                <form action="submit-login.php" method="post">
                    <div class="form-group">
                        <div>
                            <label class="form-control-label">Company Name: <span class="tx-danger">*</span></label>
                        </div>
                        <input type="hidden" name="target" value="<?= $target_id ?>">
                        <input type="text" name="company_name" class="form-control <?= (isset($_SESSION['company_name_error'])) ? 'is-invalid' : '' ?>" required>
                        <?php if (isset($_SESSION['company_name_error'])) :  ?>
                            <small class="text-danger"><?= $_SESSION['company_name_error'] ?></small>
                        <?php
                            unset($_SESSION['company_name_error']);
                        endif; ?>
                    </div>
                    <div class="form-group">
                        <div>
                            <label class="form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                        </div>
                        <input type="text" name="mobile" class="form-control <?= (isset($_SESSION['mobile_error'])) ? 'is-invalid' : '' ?>" placeholder="+880" required>
                        <?php if (isset($_SESSION['mobile_error'])) :  ?>
                            <small class="text-danger"><?= $_SESSION['mobile_error'] ?></small>
                        <?php
                            unset($_SESSION['mobile_error']);
                        endif; ?>
                    </div>
                    <button type="submit" name="send_otp" class="btn btn-info btn-block">Login</button>
                </form>
            </div><!-- login-wrapper -->
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['send_otp_status'])) { ?>
        <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
                <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">OTP Verification</div>
                <div class="tx-center mg-b-60">
                    Enter your <span class="tx-info">Verification </span> code to <span class="tx-info">verify</span>
                    you</div>
                    <form action="submit-login.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="target" value="<?= $target_id ?>">
                        <input type="text" name="otp" class="form-control <?= (isset($_SESSION['otp_error'])) ? 'is-invalid' : '' ?>" placeholder="verification code " required>
                        <?php if (isset($_SESSION['otp_error'])) :  ?>
                            <small class="text-danger"><?= $_SESSION['otp_error'] ?></small>
                        <?php
                            unset($_SESSION['otp_error']);
                        endif; ?>
                    </div>
                    <button type="submit" name="verify_you" class="btn btn-info btn-block">Login</button>
                </form>
            </div><!-- login-wrapper -->
        </div>
    <?php } ?>
    <script src=" admin/lib/jquery/jquery.js"></script>
    <script src=" admin/lib/popper.js/popper.js"></script>
    <script src=" admin/lib/bootstrap/bootstrap.js"></script>
  
</body>

</html>