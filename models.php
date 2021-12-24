<?php
require_once "admin/inc/functions.inc.php";
$title = "eModel";
require_once "header.inc.php";
?>
<section id="models" class="bg-light ">
    <div class="container">
        <div class=" py-5">
            <div class="row-news row">
                <?php
                foreach (select_all('basic_information,users', "basic_information.*,users.*", "where users.profile_id=basic_information.profile_id and users.status=1 and users.role_id=2") as $model) :
                    $profile_id = $model['profile_id'];
                    $profile_link = "profile.php?profile_id=$profile_id";
                    $profile_photo = mysqli_fetch_assoc(select_all('profile_photo', "*", "where profile_id='$profile_id '"))['image'];
                ?>
                    <div class="col-news col-sm-6 col-md-6 col-lg-4">
                        <figure class="position-relative shadow bg-white rounded">
                            <div class="position-relative models " style=" display: flex;justify-content: center;flex-wrap: wrap;">
                                <a href="<?= (isset($_SESSION['EMODEL_LOGIN'])) ? $profile_link : "login.php?target=$profile_id" ?>" style="height: 350px; width: 350px; overflow: hidden;">
                                    <img class="rounded" src="media\profile_photo\<?= $profile_photo ?>" style="width: 100%; object-fit: cover;">
                                </a>
                            </div>
                            <figcaption>
                                <h5 class="text-center"><?= $model['name'] ?></h5>
                                <h5 class="text-center"><?= "Age: " . $model['age'] ?></h5>
                            </figcaption>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php
require_once "footer.inc.php";
?>
<?php if (isset($_SESSION['error'])) : ?>
    <script>
        Swal.fire({
            position: 'top',
            icon: 'error',
            title: 'Thank you',
            text: '<?= $_SESSION['error'] ?>',
            showConfirmButton: true,
        })
    </script>
<?php
    unset($_SESSION['login_error']);
endif;
?>