<?php
require_once "admin/inc/functions.inc.php";
$title = "Contact";
require_once "header.inc.php";
?>
<div class="container">
  <div class="row">
    <div id="content" class="col-sm-12">
      <iframe class="mt-5" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.8442639328655!2d-71.10008329902021!3d42.34584359264178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e379f63dc43ccb%3A0xa15d5aa87d0f0c12!2s4+Yawkey+Way%2C+Boston%2C+MA+02215!5e0!3m2!1sen!2s!4v1475081210943" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</div>
<section class="pb-5 pt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-lg-5 col-sm-5 ">
        <div class="row">
          <div class="name-store pb-3">
            <h2 class="text-center">Contact</h2>
          </div>
          <address>
            <div class="form-group">
              <div class="icon">
                <i class="fa fa-home"></i>
                My Company, 42 avenue des Champs Elysées 75000 Paris France
              </div>
            </div>
            <div class="phone form-group">
              <div class="icon">
                <i class="fa fa-phone"></i>
                Phone : 0123456789
              </div>
            </div>
            <div class="comment">
              Maecenas euismod felis et purus consectetur, quis fermentum velition. Aenean egestas quis turpis vehicula.Maecenas euismod felis et purus consectetur, quis fermentum velition.
              Aenean egestas quis turpis vehicula.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
              The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
            </div>
          </address>
        </div>
      </div>
      <div class="col-md-7 col-lg-7 col-sm-7">
        <div class="ml-3">
          <div class="name-store">
            <h2 class="text-center">Send Message</h2>
          </div>
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
</section>
<?php
require_once "footer.inc.php";
?>
