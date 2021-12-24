<?php
$dashboard = "";
require_once('top.inc.php');

?>
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>
  <?php if (!isModel()) { ?>
    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-sm-6 col-xl-4">
          <div class="card pd-20 bg-primary">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Models</h6>
            </div><!-- card-header -->
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('users', 'id', 'role_id=2') ?></h3>
            </div><!-- card-body -->
            <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
              <div>
                <span class="tx-11 tx-white-6">Active</span>
                <h6 class="tx-white mg-b-0"><?= custom_count('users', 'id', 'role_id=2 and status=1') ?></h6>
              </div>
              <div>
                <span class="tx-11 tx-white-6">Deactive</span>
                <h6 class="tx-white mg-b-0"><?= custom_count('users', 'id', 'role_id=2 and status=0') ?></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
          <div class="card pd-20 bg-info">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Client</h6>
            </div><!-- card-header -->
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('users', 'id', 'role_id=3') ?></h3>
            </div><!-- card-body -->
            <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
              <div>
                <span class="tx-white-6">Registered</span>
                <h6 class="tx-white mg-b-0"><?= custom_count('users', 'id', 'role_id=3 and status=1') ?></h6>
              </div>
              <div>
                <span class="tx-11"><a class=" tx-white-6" href="">Waiting</a> </span>
                <h6 class="mg-b-0"><a class=" tx-white" href=""><?= custom_count('users', 'id', 'role_id=3 and status=0') ?></a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
          <div class="card pd-20 bg-purple">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Hiring Request</h6>
            </div><!-- card-header -->
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('hire_info', 'id', '') ?></h3>
            </div><!-- card-body -->
            <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
              <div>
                <span class="tx-11 tx-white-6">Completed</span>
                <h6 class="tx-white mg-b-0"><?= custom_count('hire_info', 'id', 'status=1') ?></h6>
              </div>
              <div>
                <span class="tx-11 tx-white-6">New Request</span>
                <h6 class="tx-white mg-b-0"><?= custom_count('hire_info', 'id', 'status= 0') ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Client Approval</h6>
        <p class="mg-b-20 mg-sm-b-30">Approve client register request</p>
        <div class="form-layout">
          <?php
          $row = mysqli_num_rows(select_all("users", "*", 'where status=0 ORDER BY id DESC'));
          if ($row < 1) {
            echo "<h6 class='text-danger text-center'> No request found </h6>";
          } else {
          ?>
            <!-- display responsive nowrap -->
            <table id="myTable" class="table table-responsive">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Refrence</th>
                  <th class="text-center">Mobile</th>
                  <th class="text-center">Status</th>
                  <?php if (isAdmin()) { ?>
                    <th class="text-center">Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach (select_all("users", "*", "WHERE role_id=3 and status=0 ORDER BY id DESC") as $user) :
                  $profile_id = $user['profile_id'];
                  $name = ucfirst($user['name']);
                  $role_id = $user['role_id'];
                ?>
                  <tr>
                    <td class="text-center"><?= ++$i ?></td>
                    <td class="text-center"><?= $name ?></td>
                    <td class="text-center"><?= ($user['reference']) ? $user['reference'] : "N\A" ?></td>
                    <td class="text-center"><?= (isAdmin()) ? ($user['mobile']) : "01XXXXXXXXX" ?></td>
                    <td class="text-center">
                      <span class="badge badge-<?= ($user['status'] == 1) ? 'info' : 'warning' ?>"><?= ($user['status'] == 1) ? 'Approved' : 'Not Approved' ?></span>
                    </td>
                    <?php if (isAdmin()) { ?>
                      <td class="text-center">
                        <a class="btn <?= ($user['status'] == 0) ? 'btn-teal active' : 'btn-warning' ?> mg-b-10 " href="submit-users.php?id=<?= $user['id'] ?>&task=update_status">
                          <?= ($user['status'] == 0) ? 'Approve' : 'Cancel' ?>
                        </a>
                      </td>
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Contacts</h6>
        <p class="mg-b-20 mg-sm-b-30">Please check peoples message</p>
        <div class="form-layout">
          <?php
          $row = mysqli_num_rows(select_all("contact", "*", ' ORDER BY id DESC'));
          if ($row < 1) {
            echo "<h6 class='text-danger text-center'> No message found </h6>";
          } else {
          ?>
            <!-- display responsive nowrap -->
            <table id="myTable" class="table table-responsive">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Mobile</th>
                  <th class="text-center">Message</th>
                  <th class="text-center">Status</th>
                  <?php if (isAdmin()) { ?>
                    <th class="text-center">Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach (select_all("contact", "*", ' ORDER BY id DESC') as $contact) :
                ?>
                  <tr>
                    <td class="text-center"><?= ++$i ?></td>
                    <td class="text-center text-capitalize"><?= $contact['name'] ?></td>
                    <td class="text-center"><?= (isAdmin()) ? ($contact['mobile']) : "01XXXXXXXXX" ?></td>
                    <td class="text-center"><?= mb_substr($contact['message'], 0, 60) . "..." ?></td>
                    <td class="text-center">
                      <span class="badge badge-<?= ($contact['status'] == 1) ? 'info' : 'warning' ?>"><?= ($contact['status'] == 1) ? 'Read' : 'Unread' ?></span>
                    </td>
                    <?php if (isAdmin()) { ?>
                      <td class="text-center">
                        <a class="btn btn-teal active mg-b-10 text-white" data-toggle="modal" data-target="#message<?= $contact['id'] ?>">
                          View
                        </a>
                      </td>
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- Modal -->
            <?php
            if (isAdmin()) {
              foreach (select_all("contact", "*", ' ORDER BY id DESC') as $contact) :
            ?>
                <div id="message<?= $contact['id'] ?>" class="modal fade">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content tx-size-sm">
                      <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"><?= $contact['name'] ?></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body pd-20">
                        <p class="mg-b-5"><?= $contact['message'] ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              endforeach;
            }
            ?>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <?php
    $profile_id = $_SESSION['profile_id'];
    $visitor = mysqli_fetch_assoc(select_all('basic_information', "*", "WHERE profile_id='$profile_id'"))['visitor'];
    ?>
    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-sm-6 col-xl-3">
          <div class="card pd-20 bg-primary">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total views</h6>
            </div>
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= $visitor ?></h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
          <div class="card pd-20 bg-info">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Photos</h6>
            </div>
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('photos', 'id', "profile_id='$profile_id'")  ?></h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="card pd-20 bg-purple">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Videos</h6>
            </div>
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('videos', 'id', "profile_id='$profile_id'")  ?></h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="card pd-20 bg-primary">
            <div class="d-flex justify-content-between align-items-center mg-b-10">
              <h6 class=" tx-uppercase mg-b-0 tx-spacing-1 tx-white">Previous Work</h6>
            </div>
            <div class="text-center">
              <h3 class="tx-white tx-bold"><?= custom_count('partners', 'id', "profile_id='$profile_id'") ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php
  require_once "footer.inc.php";
  ?>