<?php
require_once("inc/functions.inc.php");
if (!isset($_SESSION["EMODEL_LOGIN"])) {
    header('location: login.php');
}
notAllowed();
if (isModel()) {
    $profile_id = $_SESSION['profile_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Emodel Admin</title>
    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="css/starlight.css">
</head>

<body>
    <div class="sl-logo"><a href="index.php"><i class="icon ion-android-star-outline"></i> <?= ucfirst(single_value("author"))  ?></a></div>
    <div class="sl-sideleft">
        <label class="sidebar-label">Navigation</label>
        <div class="sl-sideleft-menu">
            <a href="index.php" class="sl-menu-link <?= (isset($dashboard)) ? "active" : "" ?>">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home tx-22"></i>
                    <span class="menu-item-label">Dashboard</span>
                </div>
            </a>
            <?php
            if (isAdmin() || ismoderator()) { ?>

                <a href="#" class="sl-menu-link <?= (isset($usermanagement)) ? "active" : "" ?> ">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-android-person-add tx-20"></i>
                        <span class="menu-item-label">User Management</span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a>
                <ul class="sl-menu-sub nav flex-column">
                    <li class="nav-item"><a href="add-user.php" class="nav-link ">Add Users </a></li>
                    <?php if (isAdmin()) { ?>
                        <li class="nav-item"><a href="moderators-list.php" class="nav-link">Moderators List </a></li>
                    <?php } ?>
                </ul>
                <a href="models-list.php" class="sl-menu-link <?= (isset($models)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon ion-android-contacts tx-20"></i>
                        <span class="menu-item-label">Models</span>
                    </div>
                </a>
                <a href="clients-list.php" class="sl-menu-link <?= (isset($Clients)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-person  tx-20"></i>
                        <span class="menu-item-label">Clients</span>
                    </div>
                </a>
                <a href="haring-request.php" class="sl-menu-link <?= (isset($haring)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-trophy  tx-20"></i>
                        <span class="menu-item-label">Haring Request</span>
                    </div>
                </a>
                <a href="services.php" class="sl-menu-link <?= (isset($services)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-briefcase  tx-20"></i>
                        <span class="menu-item-label">Service Management </span>
                    </div>
                </a>
                <a href="blog.php" class="sl-menu-link <?= (isset($blog)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-paper  tx-20"></i>
                        <span class="menu-item-label">Blog Management </span>
                    </div>
                </a>
                <a href="faq.php" class="sl-menu-link <?= (isset($faq)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-paper  tx-20"></i>
                        <span class="menu-item-label">Faq Management </span>
                    </div>
                </a>
                <a href="slider.php" class="sl-menu-link <?= (isset($slider)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-android-image  tx-20"></i>
                        <span class="menu-item-label">Slider Management</span>
                    </div>
                </a>
                <a href="general_settings.php" class="sl-menu-link <?= (isset($general_settings)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
                        <span class="menu-item-label">General Settings</span>
                    </div>
                </a>
            <?php } ?>
            <?php if (isModel()) { ?>
                <a href="info.php" class="sl-menu-link <?= (isset($info)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon ion-information-circled tx-20"></i>
                        <span class="menu-item-label">General Information</span>
                    </div>
                </a>
                <a href="photos.php" class="sl-menu-link <?= (isset($photos)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon ion-android-image tx-20"></i>
                        <span class="menu-item-label">Photos</span>
                    </div>
                </a>
                <a href="videos.php" class="sl-menu-link <?= (isset($videos)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon ion-ios-videocam tx-20"></i>
                        <span class="menu-item-label">Videos</span>
                    </div>
                </a>
                <a href="works.php" class="sl-menu-link <?= (isset($works)) ? "active" : "" ?>">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon ion-briefcase tx-20"></i>
                        <span class="menu-item-label">Previous Works</span>
                    </div>
                </a>
            <?php } ?>

        </div>
        <br>
    </div>
    <div class="sl-header">
        <div class="sl-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        </div>
        <div class="sl-header-right">
            <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name"><?= strtoupper($_SESSION['NAME'])  ?></span>
                        <i class="icon ion-android-person tx-20"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-200">
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href="change-password.php"><i class="icon ion-ios-person-outline"></i> Change Password</a></li>
                            <li><a target="_blank" href="<?= ($_SESSION["ROLE_ID"] == 2) ? "../profile.php?profile_id=$profile_id" : "../index.php" ?>"><i class="icon ion-android-globe"></i> Web page</a></li>
                            <li><a href="<?= ($_SESSION["ROLE_ID"] == 2) ? "../logout.php" : "logout.php" ?>"><i class="icon ion-power"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>