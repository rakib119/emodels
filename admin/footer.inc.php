  <footer class="sl-footer">
      <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; <?= date('Y') ?>. Emodels. All Rights Reserved.</div>
      </div>
  </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src=" lib/popper.js/popper.js"></script>
  <script src=" lib/bootstrap/bootstrap.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <script src=" js/starlight.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#myTable').DataTable();
      });
  </script>
  <?php if (isset($_SESSION['success'])) : ?>
      <script>
          const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2500,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
          })

          Toast.fire({
              icon: 'success',
              title: '<?= $_SESSION['success'] ?>'
          })
      </script>
  <?php
        unset($_SESSION['success']);
    endif;
    ?>
  <script>
      $(".delete_row").click(function() {
          var link = $(this).val();
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to delete this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
          }).then((result) => {
              //   alert(link);
              if (result.isConfirmed) {
                  window.location.href = link;
              }
          })
      });
  </script>
  <!-- error alert -->


  </body>

  </html>