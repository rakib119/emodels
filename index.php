<?php
require_once "admin/inc/functions.inc.php";
$title = "eModel";
require_once "header.inc.php";
?>
<div></div>
<!-- scroolbar -->

<?php if (single_value("scrollbar")) : ?>
  <marquee direction="left" height="35px" width="100%" class="scroolbar" bgcolor="#23a592">
    <p class="text-white"><?= single_value("scrollbar") ?></h4>
  </marquee>
<?php endif ?>
<!-- slider -->
<script src="js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
  window.jssor_1_slider_init = function() {

    var jssor_1_options = {
      $AutoPlay: 1,
      $SlideWidth: 720,
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$,
        $SpacingX: 16,
        $SpacingY: 16
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 980;

    function ScaleSlider() {
      var containerElement = jssor_1_slider.$Elmt.parentNode;
      var containerWidth = containerElement.clientWidth;

      if (containerWidth) {

        var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

        jssor_1_slider.$ScaleWidth(expectedWidth);
      } else {
        window.setTimeout(ScaleSlider, 30);
      }
    }

    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*#endregion responsive code end*/
  };
</script>
<style>
  /*jssor slider loading skin spin css*/
  .jssorl-009-spin img {
    animation-name: jssorl-009-spin;
    animation-duration: 1.6s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
  }

  @keyframes jssorl-009-spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  /*jssor slider bullet skin 051 css*/
  .jssorb051 .i {
    position: absolute;
    cursor: pointer;
  }

  .jssorb051 .i .b {
    fill: #fff;
    fill-opacity: 0.3;
  }

  .jssorb051 .i:hover .b {
    fill-opacity: .7;
  }

  .jssorb051 .iav .b {
    fill-opacity: 1;
  }

  .jssorb051 .i.idn {
    opacity: .3;
  }

  /*jssor slider arrow skin 051 css*/
  .jssora051 {
    display: block;
    position: absolute;
    cursor: pointer;
  }

  .jssora051 .a {
    fill: none;
    stroke: #fff;
    stroke-width: 360;
    stroke-miterlimit: 10;
  }

  .jssora051:hover {
    opacity: .8;
  }

  .jssora051.jssora051dn {
    opacity: .5;
  }

  .jssora051.jssora051ds {
    opacity: .3;
    pointer-events: none;
  }
</style>
<div id="jssor_1" style="position:relative;margin:0 auto;top:20px;left:20px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
  <!-- Loading Screen -->
  <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="media/icon/spin.svg" />
  </div>
  <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
    <?php
    foreach (select_all("slider", "*", "WHERE status=1") as $slider) : ?>
      <div>
        <img data-u="image" src="media/slider/<?= $slider['slider_image'] ?>" />
      </div>
    <?php endforeach ?>
  </div><a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">animation</a>
  <!-- Bullet Navigator -->
  <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:16px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
    <div data-u="prototype" class="i" style="width:12px;height:12px;">
      <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
        <circle class="b" cx="8000" cy="8000" r="5800"></circle>
      </svg>
    </div>
  </div>
  <!-- Arrow Navigator -->
  <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
      <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
    </svg>
  </div>
  <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
      <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
    </svg>
  </div>
</div>
<script type="text/javascript">
  jssor_1_slider_init();
</script>

<!-- service start -->
<section class="text-center pb-5 pt-3" id="service">
  <div class="container">
    <div class="row">
      <div class="col-md-12 " data-aos="fade-up">
        <h3 class="text-center text-uppercase text-primary mb-3 pt-3 mb-md-0">Our Services</h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div id="owl-carousel-service" class="owl-carousel owl-theme">
        <?php
        foreach (select_all('services', "*", "WHERE status=1 ORDER BY id DESC") as $service) :
        ?>
          <div class="item mt-4">
            <figure class="position-relative ">
              <div class="position-relative services" style="display: flex;justify-content: center;flex-wrap: wrap;">
                <a href="<?= "#" ?>" style="height: 250px;width: 350px;overflow: hidden;">
                  <img class="rounded" src="media\services\<?= $service['service_photo'] ?>" style="height: 250px;width: 100%;object-fit: cover;">
                </a>
              </div>
              <a href="">
                <h6><?= $service['title'] ?></h6>
              </a>
              <p class="px-5 text-left"><?= mb_substr($service['service_details'], 0, 80) . "..." ?></p>
            </figure>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<!-- service End -->
<!-- FAQ start -->
<section class="bg-light pb-5 pt-3" id="faq">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-6 ">
        <div data-aos="fade-up">
          <h3 class="text-center text-primary text-uppercase">FAQ</h3>
          <hr class="hr-white">
        </div>
        <div id="accordion">
          <?php
          $i = 0;
          foreach (select_all('faq', "*", "WHERE status=1") as $faq) :
            $i++;
            // if ($i == 1) {
            //   $class1 = '';
            //   $class2 = 'collapse show';
            //   $expanded = "true";
            // } else {
            //   $class = 'collapsed ';
            //   $class2 = 'collapse';
            //   $expanded = "false";
            // }
            $class = 'collapsed ';
            $class2 = 'collapse';
            $expanded = "false";
          ?>
            <div class="card">
              <a class="<?= $class1 ?>" type="button" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="<?= $expanded ?>" aria-controls="collapse<?= $i ?>">
                <div class="card-header d-flex justify-content-between" id="heading<?= $i ?>">
                  <h5 class="my-0"> <?= $faq['question'] ?> </h5>
                  <h5 class="my-0"><i class="fa fa-caret-down" aria-hidden="true"></i>
                  </h5>
                </div>
              </a>
              <div id="collapse<?= $i ?>" class="<?= $class2 ?> pe-auto" aria-labelledby="heading<?= $i ?>" data-parent="#accordion">
                <div class="card-body">
                  <?= $faq['answere'] ?>
                </div>
              </div>
            </div>
          <?php
          endforeach
          ?>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-sm-6">
        <div>
          <div data-aos="fade-up">
            <h3 class="text-center text-uppercase text-primary">Working Video</h3>
            <hr class="hr-white">
          </div>
          <div class="iframe-container">
            <iframe src="<?= single_value("working_video_link") ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        <div class="pt-3">
          <h3 class="text-center text-uppercase text-primary">Contact Us</h3>
          <hr class="hr-white">
          <p class="mb-4">On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized b</p>
          <div class="text-center">
            <button type="button" class="btn" data-toggle="modal" data-target="#send-request">Let's talk</button>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- FAQ END -->
<!-- Blog -->
<section id="blog" class=" pb-5 pt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 " data-aos="fade-up">
        <h3 class="text-center text-uppercase text-primary">Blogs</h3>
        <hr class="hr-white">
      </div>
    </div>
    <div class="row">
      <div id="owl-carousel-blogs" class="owl-carousel owl-theme">
        <?php
        foreach (select_all('blogs', "*", "WHERE status=1 ORDER BY id DESC") as $blog) :
        ?>
          <div class="item mt-4">
            <figure class="position-relative ">
              <div class="position-relative services" style="display: flex;justify-content: center;flex-wrap: wrap;">
                <a href="blog_details.php?id=<?= $blog['id'] ?>" style="height: 250px;width: 350px;overflow: hidden;">
                  <img class="rounded" src="media\blog\<?= $blog['blog_photo'] ?>" style="height: 250px;width: 100%;object-fit: cover;">
                </a>
              </div>
              <a href="blog_details.php?id=<?= $blog['id'] ?>">
                <h6 class="text-center"><?= $blog['title'] ?></h6>
              </a>
              <p class="px-5 text-left"><?= mb_substr($blog['blog_description'], 0, 80) . "..." ?></p>
            </figure>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="send-request">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title mt-0">Send Message</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Leave your contacts and our team
          will contact you soon.</p>
        <form method="post" action="send_message.php">
          <div class="form-group">
            <input type="text" name="name" class="form-control" required="" placeholder="Name *">
            <small class="text-danger"> </small>
          </div>
          <div class="form-group">
            <input type="text" name="mobile" class="form-control" required="" placeholder="Mobile *">
          </div>
          <div class="form-group">
            <textarea rows="3" name="message" class="form-control" required="" placeholder="Message *"></textarea>
          </div>
          <div class="form-group mb-0 text-right">
            <button type="submit" name="submit" class="btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
require_once "footer.inc.php";
?>
<script>
  $('#owl-carousel-service').owlCarousel({
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
  unset($_SESSION['error']);
endif;
?>