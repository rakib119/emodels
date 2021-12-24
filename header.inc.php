<?php
$script_name = $_SERVER['SCRIPT_NAME'];
$script_name_arr = explode('/', $script_name);
$mypage = $script_name_arr[count($script_name_arr) - 1];
$script_name = $_SERVER['SCRIPT_NAME'];
$script_name_arr = explode('/', $script_name);
$mypage = end($script_name_arr);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= ucfirst(single_value("author"))  ?>">
    <meta name="author" content="Paul">
    <!--<meta property="og:title" content="<?= $title ?>" />-->
    <!--<meta property="og:image" content="https://images.app.goo.gl/fA4kYpMpTCG52Mdf7" />-->
    <!--<meta property="og:url" content="<?= $actual_link ?>" />-->
    <!--<meta property="og:title" content="<?= "http://$_SERVER[HTTP_HOST]" ?>" />-->
    <!-- title -->
    <title><?= $title ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css" />
    <link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="admin/lib/font-awesome/css/font-awesome.css">
</head>

<body>
    <!-- Loader -->
    <!-- <div class="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div> -->

    <!-- Click capture -->
    <div class="click-capture d-lg-none"></div>
    <!-- Navbar -->

    <!-- Navbar -->
    <nav id="scrollspy" class="navbar navbar-desctop">
        <div class="d-flex position-relative w-100">
            <button class="toggler d-lg-none mr-auto">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
            <!-- Brand-->
            <a class="navbar-brand" href="index.php"><?= single_value("author") ?></a>
            <ul class="navbar-nav-desctop mr-auto d-none d-lg-block">
                <?php if ($script_name == '/profile.php') { ?>
                    <li><a class="nav-link" href="index.php">Home</a></li>
                    <li><a class="nav-link" href="#home">profile</a></li>
                    <li><a class="nav-link" href="#photos">Photos</a></li>
                    <li><a class="nav-link" href="#videos">Videos</a></li>
                    <li><a class="nav-link" href="models.php">Models</a></li>
                <?php } else if ($script_name == '/index.php') { ?>
                    <li><a class="nav-link" href="index.php">Home</a></li>
                    <li><a class="nav-link" href="models.php">Models</a></li>
                    <li><a class="nav-link" href="#service">Service</a></li>
                    <li><a class="nav-link" href="#faq">Faq</a></li>
                    <li><a class="nav-link" href="#blog">Blog</a></li>
                <?php } else { ?>

                    <li><a class="nav-link" href="index.php">Home</a></li>
                    <li><a class="nav-link" href="models.php">Models</a></li>
                    <li><a class="nav-link" href="index.php#service">Service</a></li>
                    <li><a class="nav-link" href="index.php#faq">Faq</a></li>
                    <li><a class="nav-link" href="index.php#blog">Blog</a></li>
                <?php } ?>
                <li><a class="nav-link" href="contact.php">Contact us</a></li>
            </ul>
            <ul class="social-icons  d-sm-block">
                <li>
                    <a href="#" target="blank">
                        <ion-icon name="search"></ion-icon>
                    </a>
                </li>
                <li class="navbar-login">
                    <div class="dropdown text-uppercase">
                        <?php if (!isset($_SESSION['EMODEL_LOGIN'])) { ?>
                            <!--<a href="javascriptVoid(0)" class="dropdown-toggle pe-auto" id="dropdownMenuButton" class="sp-btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    login-->
                            <!--</a>-->
                            <a href="login.php" class="pe-auto" class="sp-btn-link">
                                login
                            </a>

                            <!--<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">-->
                            <!--    <a class="dropdown-item" href="login.php">-->
                            <!--        <ion-icon name="person"></ion-icon>&nbsp;&nbsp; User Login-->
                            <!--    </a>-->
                            <!--    <div class="dropdown-divider"></div>-->
                            <!--    <a class="dropdown-item pe-auto" href="model_login.php">-->
                            <!--        <ion-icon name="person"></ion-icon>&nbsp;&nbsp; Model's login-->
                            <!--    </a>-->
                            <!--</div>-->
                        <?php } else { ?>
                            <a href="javascriptVoid(0)" class="dropdown-toggle" class="sp-btn-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $name = $_SESSION['NAME'];
                                echo $name = explode(" ", $name)['0'];
                                ?>
                            </a>

                            <div class="dropdown-menu" style="left: -39px  !important;" aria-labelledby="dropdownMenuButton">
                                <?php if (isClient()) { ?>
                                    <a class="dropdown-item pe-auto" href="logout.php">
                                        <ion-icon name="log-out"></ion-icon>&nbsp;&nbsp;Logout
                                    </a>
                                <?php  } else { ?>
                                    <a target="_blank" class="dropdown-item" href="admin/index.php">
                                        <ion-icon name="person"></ion-icon>&nbsp;&nbsp; Dashboard
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item pe-auto" href="logout.php">
                                        <ion-icon name="log-out"></ion-icon>&nbsp;&nbsp;Logout
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar Mobile -->
    <nav id="navbar-mobile" class="navbar navbar-mobile d-lg-none">
        <ion-icon class="close" name="close-outline"></ion-icon>
        <ul class="navbar-nav navbar-nav-mobile">
            <?php if ($script_name == '/profile.php') { ?>
                <li><a class="nav-link" href="index.php">Home</a></li>
                <li><a class="nav-link" href="#home">profile</a></li>
                <li><a class="nav-link" href="#photos">Photos</a></li>
                <li><a class="nav-link" href="#videos">Videos</a></li>
                <li><a class="nav-link" href="models.php">Models</a></li>
            <?php } else if ($script_name == '/index.php') { ?>
                <li><a class="nav-link" href="index.php">Home</a></li>
                <li><a class="nav-link" href="models.php">Models</a></li>
                <li><a class="nav-link" href="#service">Service</a></li>
                <li><a class="nav-link" href="#faq">Faq</a></li>
                <li><a class="nav-link" href="#blog">Blog</a></li>
            <?php } else { ?>

                <li><a class="nav-link" href="index.php">Home</a></li>
                <li><a class="nav-link" href="models.php">Models</a></li>
                <li><a class="nav-link" href="index.php#service">Service</a></li>
                <li><a class="nav-link" href="index.php#faq">Faq</a></li>
                <li><a class="nav-link" href="index.php#blog">Blog</a></li>
            <?php } ?>
            <li><a class="nav-link" href="contact.php">Contact us</a></li>
        </ul>
        <div class="navbar-mobile-footer">
            <p>&copy; <?= date("Y ") . single_value("author") ?>. All Rights Reserved.</p>
        </div>
    </nav>
    <!-- Masthead -->