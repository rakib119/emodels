<!-- Footer -->
<footer>
  <div class="section bg-dark py-5 pb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <h6 class="text-white mb-4">Phone:</h6>
          <p class="text-white mb-4"><?= single_value("mobile") ?></p>
        </div>
        <div class="col-md-6 col-lg-3 ">
          <h6 class="text-white mb-4">Email:</h6>
          <p class="text-white mb-4"><?= single_value("email") ?></p>
        </div>
        <div class="col-md-6 col-lg-3 ">
          <h6 class="text-white mb-4">Address:</h6>
          <p class="text-white mb-4"><?= single_value("Address") ?></p>
        </div>
        <div class="col-md-6 col-lg-3 ">
          <h6 class="text-white mb-4">Share Link:</h6>
          <div class="single-b-wrap " id="social-links">
            <!-- desktop share -->
            <ul class="social-icons mt-3 d-flex">
              <li>
                <a href="" id="gmail-btn"><i class="fa fa-envelope-o" aria-hidden="true" style=" font-size: 1.5rem"></i></a>
              </li>
              <li>
                <a href="" id="facebook-btn"><i class="fa fa-facebook-square" aria-hidden="true" style=" font-size: 1.5rem"></i></a>
              </li>
              <li>
                <a href="" id="gplus-btn"><i class="fa fa-google-plus-square" aria-hidden="true" style=" font-size: 1.5rem"></i>
                </a>
              </li>
              <li>
                <a href="" id="twitter-btn"><i class="fa fa-twitter-square" aria-hidden="true" style="font-size: 1.5rem"></i>
                </a>
              </li>
              <li>
                <a href="" id="linkedin-btn"><i class="fa fa-linkedin-square" aria-hidden="true" style=" font-size: 1.5rem"></i>
                </a>
              </li>
              <li>
                <a href="" id="whatsapp-btn"><i class="fa fa-whatsapp" aria-hidden="true" style=" font-size: 1.5rem"></i>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)" id="clipboard" data-toggle="tooltip" title="Copy to clipboard" onclick="copy_Share_Button()">
                  <i class="fa fa-clone" style="font-size: 1.5rem"></i>
                </a>
              </li>
            </ul>

          </div>
          <div class="text-center">
            <button class="btn" style="display: none;" id="shareBtn"><i class="fa fa fa-share text-white" aria-hidden="true"></i> Share</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copy section-sm">
    <div class="container">© Copyright <?= date("Y") ?> <?= single_value("author") ?>. All Rights Reserved</div>
  </div>
</footer>
<!-- Optional JavaScript -->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="js/jarallax.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/interface.js"></script>
<script src="js\lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="js/main.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  lightGallery(document.querySelector("#photo-gallery"));
</script>
<!--Copy Link-->
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })

  // video player
  var videoPlayer = document.getElementById('videoPlayer');
  var modelVideo = document.getElementById('modelVideo');

  modelVideo.addEventListener('ended', stopVideo, false);

  function stopVideo() {
    modelVideo.pause();
    videoPlayer.style.display = 'none';
  }

  function playVideo(file) {
    modelVideo.src = file;
    videoPlayer.style.display = 'block';
  };
</script>
</body>

</html>

<?php if (isset($_SESSION['success'])) : ?>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    Toast.fire({
      icon: 'success',
      title: '<?= $_SESSION['success'] ?>'
    });
  </script>
<?php endif; ?>
<?php if (isset($_SESSION['hire_msg'])) : ?>
  <script>
    Swal.fire({
      position: 'top',
      icon: 'success',
      title: 'Thank you!',
      text: '<?= $_SESSION['hire_msg'] ?>',
      showConfirmButton: true,
    })
  </script>
<?php
  unset($_SESSION['hire_msg']);
endif;
?>

<?php
unset($_SESSION['success']);

?>
<script type="text/javascript">
  function copy_Share_Button() {

    //----< copy_Share_Button() >----

    var sURL = window.location.href;

    sTemp = "<input id=\"copy_to_Clipboard\" value=\"" + sURL + "\" />"

    $("body").append(sTemp);

    $("#copy_to_Clipboard").select();
    document.execCommand("copy");
    // alert
    document.getElementById('copied').style.display = "block";
    document.getElementById('copyto').style.display = "none";
    // const Toast = Swal.mixin({
    //   toast: true,
    //   position: 'top-end',
    //   showConfirmButton: false,
    //   timer: 1000,
    //   // timerProgressBar: true,

    // });

    // Toast.fire({
    //   icon: 'success',
    //   title: 'Link Copied'
    // });

    $("#copy_to_Clipboard").remove();

  }
  // Social Share links.
  const gmailBtn = document.getElementById('gmail-btn');
  const facebookBtn = document.getElementById('facebook-btn');
  const gplusBtn = document.getElementById('gplus-btn');
  const linkedinBtn = document.getElementById('linkedin-btn');
  const twitterBtn = document.getElementById('twitter-btn');
  const whatsappBtn = document.getElementById('whatsapp-btn');
  const socialLinks = document.getElementById('social-links');
  const clipboard = document.getElementById('clipboard');
  const mainDiv = document.getElementById('links');
  // posturl posttitle
  let postUrl = encodeURI(document.location.href);
  let postTitle = encodeURI('<?= $model_info['name'] ?>');
  facebookBtn.setAttribute("href", `https://www.facebook.com/sharer.php?u=${postUrl}`);
  twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
  linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);
  whatsappBtn.setAttribute("href", `https://wa.me/?text=${postTitle} ${postUrl}`);
  gmailBtn.setAttribute("href", `https://mail.google.com/mail/?view=cm&su=${postTitle}&body=${postUrl}`);
  gplusBtn.setAttribute("href", `https://plus.google.com/share?url=${postUrl}`);

  // Button
  const shareBtn = document.getElementById('shareBtn');
  if (navigator.share) {
    $("#social-links").hide();
    shareBtn.style.display = 'block';

    shareBtn.addEventListener('click', () => {
      navigator.share({
        title: postTitle,
        url: postUrl
      }).then((result) => {
        // alert('Thank You for Sharing.')
      }).catch((err) => {
        console.log(err);
      });;
    });
  }
</script>
<script>
  // disable write click
  $(document).bind("contextmenu", (e) => false);
  // disable mouse hold
  $(document).on("mousedown", "*", null, function(ev) {
    ev.preventDefault();
  });
  // disable some keys
  document.onkeydown = function(e) {
    if (e.keyCode == 123) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
      return false;
    }

    if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
      return false;
    }
  }
</script>