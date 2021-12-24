<?php
require_once "admin/inc/functions.inc.php";
$title = "eModel";
require_once "header.inc.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = select_all('blogs',"*", "WHERE status=1 and id=$id");
    if(!mysqli_num_rows($sql)){
        ?>
    <script>
        window.location.href="index.php";
    </script>
<?php    
    }else{
        $blog = mysqli_fetch_assoc($sql);
    }
}else{
?>
<script>
    window.location.href="index.php";
</script>
<?php
}
?>
<section class="section">
    <div class="container">
        <h2 data-aos="fade-up text-primary"><?= ucfirst($blog['title'])  ?></h2>
        <section class="mt-4">
            <div class="row">
                <div class="col-md-12 col-lg-12 mb-12 mb-md-12" data-aos="fade-up">
                    <div class="square">
                        <div>
                            <img class="blog_photo" src="media/blog/<?= $blog['blog_photo'] ?>" alt="" sizes="100" srcset="">
                            <p class="blog_photo my-2"> <b>Caption:</b> <?= ucfirst($blog['title'] )?></p>
                        </div>
                        <p class="blog_description"><?= $blog['blog_description'] ?>
                        </p>

                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- Blog -->
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-aos="fade-up">
                <h2 class="text-center text-primary">All Blogs</h2>
                <hr class="hr-white">
            </div>
        </div>
        <div class="row mb-4">
            <div id="owl-carousel-blogs" class="owl-carousel owl-theme">
                <?php
                foreach (select_all('blogs', "*", "WHERE status=1 ORDER BY id DESC") as $blog) :
                ?>
                    <div class="item mt-4">
                        <figure class="position-relative ">
                            <div class="position-relative services" style="display: flex;justify-content: center;flex-wrap: wrap;">
                                <a href="blog.php?id=<?= $blog['id'] ?>" style="height: 250px;width: 350px;overflow: hidden;">
                                    <img class="rounded" src="media\blog\<?= $blog['blog_photo'] ?>" style="height: 250px;width: 100%;object-fit: cover;">
                                </a>
                            </div>
                            <a href="blog.php?id=<?= $blog['id'] ?>">
                                <h6 class="text-center"><?= $blog['title'] ?></h6>
                            </a>
                            <p class="px-5 text-left"><?= mb_substr($blog['blog_description'], 0, 80) . "..." ?></p>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</section>
<?php
require_once "footer.inc.php";
?>
<script>
      $('#owl-carousel-blogs').owlCarousel({
    margin: 10,
    // responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 100,
    autoplayTimeout: 2500,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
        loop: true
      },
      480: {
        items: 2,
        loop: true
      },
      768: {
        items: 3,
        loop: true
      }
    }
  })
</script>
