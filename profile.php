<?php
require_once "admin/inc/functions.inc.php";
if (!isset($_GET['profile_id'])) {
    header('location: index.php');
}
$profile_id = ($_GET['profile_id']);
if (isset($_SESSION['EMODEL_LOGIN'])) {
    $profile_id = ($_GET['profile_id']);

    $profile_photo = mysqli_fetch_assoc(select_all('profile_photo', "*", "where profile_id='$profile_id '"))['image'];
    $model_info = mysqli_fetch_assoc(select_all('users', "*", "WHERE profile_id='$profile_id'"));
    if (!$model_info) {
        rejected();
    }
    $personal_info = mysqli_fetch_assoc(select_all('basic_information', "*", "WHERE profile_id='$profile_id'"));
    $total_photos = mysqli_num_rows(select_all("photos", "*", "where profile_id='$profile_id'and status=1"));
    $total_videos = mysqli_num_rows(select_all("videos", "*", "where profile_id='$profile_id'and status=1"));
    $total_partners = mysqli_num_rows(select_all("partners", "*", "where profile_id='$profile_id'and status=1"));
    $title = single_value("author") . " " . $model_info['name'];
    require_once "header.inc.php";
    $previous_visitor =  $personal_info['visitor'];
    $current_visitor = $previous_visitor + 1;
    update_data('basic_information', "visitor='$current_visitor'", "profile_id='$profile_id'");
?>
    <!-- About -->
    <section id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6" data-aos="fade-in" data-aos-delay="0">
                    <figure class="position-relative profile_picture">
                        <div class="position-relative profile_photo"><img alt="<?= $model_info['name'] ?>'s ptofile picture" src="media\profile_photo\<?= $profile_photo ?>">
                        </div>
                    </figure>
                    <div class="row mt-3">
                        <?php if ($personal_info['skill'] != "") : ?>
                            <?php
                            $keywords = explode(",", $personal_info['skill']);
                            ?>
                            <div class="col-lg-12 experience d-flex align-items-center">
                                <h5>Expertise: </h5>
                                <?php foreach ($keywords as $keyword) : ?>
                                    <span class="ml-2 text-capitalize"><?= $keyword ?></span>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="profile-info col-md-6 col-lg-6 col-sm-6 col-xs-6 col-xl-6 mt-5">
                    <div class="experience align-items-center">
                        <h2 style="margin: 0 !important;" class="model-name text-primary"><?= $model_info['name'] ?></h2>
                        <?php if (!isClient()) { ?>
                            <small> <i class="fa fa-eye" style="color: #665b5b; font-size: 1.2rem"></i> <?= $current_visitor ?> views</small>
                        <?php } ?>
                    </div>
                    <?php if ($personal_info['age'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">AGE:</h5> <span class="ml-2"> <?= $personal_info['age'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($model_info['mobile'] != "") : ?>
                        <?php if (isAdmin()) : ?>
                            <div class="experience d-flex align-items-center">
                                <h5 class="">MOBILE:</h5> <span class="ml-2"> <?= $model_info['mobile'] ?> <?= ($personal_info['optional_number'] != "") ?  " , " . $personal_info['optional_number']  : "" ?></span>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if ($personal_info['skin'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">SKIN:</h5> <span class="ml-2"> <?= $personal_info['skin'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['height'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">HEIGHT:</h5> <span class="ml-2"> <?= $personal_info['height'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['weight'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">WAIGHT:</h5><span class="ml-2"><?= $personal_info['weight'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['bust'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">BUST: </h5> <span class="ml-2"><?= $personal_info['bust'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['waist'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">WAIST:</h5><span class="ml-2"><?= $personal_info['waist'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['chest'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">CHEST:</h5><span class="ml-2"><?= $personal_info['chest'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['hip'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">HIP: </h5><span class="ml-2"><?= $personal_info['hip'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['education'] != "") : ?>
                        <div class="experience d-flex align-items-center">
                            <h5 class="">EDUCATION:</h5><span class="ml-2"><?= $personal_info['education'] ?></span>
                        </div>
                    <?php endif ?>
                    <?php if ($personal_info['price'] != "") : ?>
                        <?php if (isAdmin()) : ?>
                            <div class="experience d-flex align-items-center">
                                <h5 class="">ASKING PRICE:</h5> <span class="ml-2"> <?= $personal_info['price'] ?></span>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php if ($personal_info['address'] != "") : ?>
                        <?php if (isAdmin()) : ?>
                            <div class="experience">
                                <h5>ADDRESS:</h5> <span> <?= $personal_info['address'] ?></span>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php if ($personal_info['address'] != "") : ?>
                        <div class="experience">
                            <h5>ABOUT:</h5> <span> <?= $personal_info['about'] ?></span>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="d-flex justify-content-center py-4">
                <div class="social-share text-center">
                    <div class="single-b-wrap" id="social-links">
                        <!-- desktop share -->
                        <ul class="social-icons mt-3 d-flex">
                            <li>
                                <a href="#" id="gmail-btn"><i class="fa fa-envelope-o" aria-hidden="true" style="color: #cf3e39; font-size: 2rem"></i></a>
                            </li>
                            <li>
                                <a href="#" id="facebook-btn"><i class="fa fa-facebook-square" aria-hidden="true" style="color: #3b5998; font-size: 2rem"></i></a>
                            </li>
                            <li>
                                <a href="#" id="gplus-btn"><i class="fa fa-google-plus-square" aria-hidden="true" style="color: #dd4b39; font-size: 2rem"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="twitter-btn"><i class="fa fa-twitter-square" aria-hidden="true" style="color: #1da1f2; font-size: 2rem"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="linkedin-btn"><i class="fa fa-linkedin-square" aria-hidden="true" style="color: #0077b5; font-size: 2rem"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="whatsapp-btn"><i class="fa fa-whatsapp" aria-hidden="true" style="color: #25d366; font-size: 2rem"></i>
                                </a>
                            </li>
                            <li id="copyto">
                                <a href="javascript:void(0)" id="clipboard" data-toggle="tooltip" title="Copy to clipboard" onclick="copy_Share_Button()">
                                    <i class="fa fa-clone" style="color: #665b5b; font-size: 2rem"></i>
                                </a>
                            </li>
                            <li id="copied" style="display:none">
                                <a href="javascript:void(0)" id="clipboard2" data-toggle="tooltip" title="Coppied" onclick="copy_Share_Button()">
                                    <i class="fa fa-clone" style="color: #665b5b; font-size: 2rem"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="hire-btn d-flex justify-content-center ml-5">
                    <div class="px-2">
                        <button class="btn" style="display: none;" id="shareBtn"><i class="fa fa fa-share text-white" aria-hidden="true"></i> Share</button>
                    </div>
                    <div class="px-2">
                        <?php
                        if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'client') {
                        ?>
                            <a href="hire.php?pid=<?= $profile_id ?>" class="btn ">Hire me</a>
                        <?php
                        } else {
                        ?>
                            <button type="button" class="btn ">Hire me</button>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- photos -->
    <?php if ($total_photos) : ?>
        <section id="photos" class="bg-light pb-5 pt-3">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-md-12" data-aos="fade-up">
                        <h2 class="text-primary text-center">Photos</h2>
                        <hr class="hr-white">
                    </div>
                </div>
                <div class="gallery row ">
                    <div id="photo-gallery" class="light-gallery col-md-12 col-lg-12 col-sm-2">
                        <?php
                        foreach (select_all("photos", "*", "WHERE profile_id='$profile_id' and status=1 order by id DESC") as $photo) :
                        ?>
                            <a href="media/photos/<?= $photo['photo'] ?>" style="border: .5px solid #dfd5d5">
                                <div>
                                    <img src="media/photos/<?= $photo['photo'] ?>">
                                </div>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>

    <!-- video -->
    <?php if ($total_videos) : ?>
        <section id="videos" class="pb-5 pt-3">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-md-12" data-aos="fade-up">
                        <h2 class=" text-center text-primary">Videos</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $profile_id = $_GET['profile_id'];
                    foreach (select_all("videos", "*", "WHERE profile_id='$profile_id' and status=1 and status=1 order by id DESC LIMIT 12") as $video) :
                        $video_path = "media/videos/" . $video['video'];
                    ?>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-sm-2 mt-3" data-aos="fade-in" data-aos-delay="0">
                            <figure class="position-relative video_gallery">
                                <div class="position-relative video_thumbnail">
                                    <img class="thumbnail" src="media/thumbnails/<?= $video['thumbnail'] ?>">
                                    <img src="media/icon/play.png" alt="play" class="play-btn" onclick="playVideo('<?= $video_path ?>')">
                                </div>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                    <div class="video-player bg-white" id="videoPlayer">
                        <video width="100%" height="520" controls autoplay id="modelVideo" controlsList="nodownload">
                            <source src="videos\video.mp4" type="video/mp4">
                            <img src="media/icon/play.png" alt="X" class="close-btn">
                        </video>
                        <img src="media/icon/close.png" alt="X" class="close-btn" onclick="stopVideo()">
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- Partners -->
    <?php if ($total_partners) : ?>
        <section id="testimonials" class="pb-5 pt-3 bg-light">
            <div class="container">
                <div class="col-md-12" data-aos="fade-up">
                    <h3 class="text-center text-primary">Work With</h3>
                    <hr class="hr-white">
                </div>
                <div class="row">
                    <div id="owl-carousel-partners" class="owl-carousel owl-theme">
                        <?php
                        foreach (select_all("partners", "*", "where profile_id='$profile_id'and status=1 order by id DESC") as $partners) :
                        ?>
                            <div class="item mt-4">
                                <figure class="position-relative ">
                                    <div class="position-relative" style="display: flex;justify-content: center;flex-wrap: wrap;">
                                        <div class="card shadow bg-white rounded">
                                            <div class="card-body ">
                                                <h3 style="font-family: 'Brush Script MT', cursive;"> <?= $partners['partner_name'] ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- More Models -->
    <?php if ($_SESSION["ROLE_ID"] != 2) : ?>
        <section class="pb-5 pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 " data-aos="fade-up">
                        <h3 class="text-center text-uppercase text-primary">More Models</h3>
                        <hr class="hr-white">
                    </div>
                </div>
                <div class="row">
                    <div id="more_models" class="owl-carousel owl-theme">
                        <?php
                        foreach (select_all('basic_information,users', "basic_information.*,users.*", "where users.profile_id=basic_information.profile_id and users.status=1 and users.role_id=2") as $model) :
                            $profile_id = $model['profile_id'];
                            $profile_link = "profile.php?profile_id=$profile_id";
                            $profile_photo = mysqli_fetch_assoc(select_all('profile_photo', "*", "where profile_id='$profile_id '"))['image'];
                        ?>
                            <div class="item mt-4">
                                <figure class="position-relative ">
                                    <div class="position-relative services" style="display: flex;justify-content: center;flex-wrap: wrap;">
                                        <a href="<?= (isset($_SESSION['EMODEL_LOGIN'])) ? $profile_link : "login.php?target=$profile_id" ?>" style="height: 320px;width: 350px;overflow: hidden;">
                                            <img class="rounded" src="media\profile_photo\<?= $profile_photo ?>" style="width: 100%;object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class=" text-center">
                                        <a href="<?= (isset($_SESSION['EMODEL_LOGIN'])) ? $profile_link : "login.php?target=$profile_id" ?>">
                                            <h6><?= $model['name'] ?></h6>
                                        </a>
                                        <p>Age: <?= $model['age'] ?></p>
                                    </div>
                                </figure>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
        </section>
    <?php endif ?>
<?php
    require_once "footer.inc.php";
} else {
    $id = $_GET['profile_id'];
    header("location: login.php?target=$id");
}
?>
<script>
    $('#more_models').owlCarousel({
        margin: 10,
        // responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 100,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2,
                loop: true
            },
            480: {
                items: 3,
                loop: true
            },
            768: {
                items: 4,
                loop: true
            }
        }
    })
    $('#owl-carousel-partners').owlCarousel({
        margin: 10,
        // responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 100,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2,
                loop: true
            },
            480: {
                items: 2,
                loop: true
            },
            768: {
                items: 5,
                loop: true
            }
        }
    })
</script>