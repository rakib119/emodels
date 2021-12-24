<?php
$works = "";
require_once "top.inc.php";
if (!isModel()) { ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
if (isset($_POST['submit_partners'])) {
    $flag = 0;
    $profile_id = $_SESSION['profile_id'];
    $partner_name = get_safe_value($_POST['partner_name']);
    if ($flag == 0) {
        $column_name = "partner_name,profile_id,status";
        $values = "'$partner_name','$profile_id',0";
        $insert = insert_query("partners", $column_name, $values);
        if ($insert) {
            $_SESSION['success'] = "partners added successfully";
        }
    }
}
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Previous Works</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-partner_name">Previous Works</h6>
            <p class="mg-b-20 mg-sm-b-30">Add Company Name If you work with this company.</p>
            <div class="form-layout">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <div>
                            <label class="form-control-label" for="file">Company Name: <span class="tx-danger">*</span></label>
                        </div>
                        <input type="text" name="partner_name" class="form-control" required>
                        <?php if (isset($_SESSION['partner_name_error'])) : ?>
                            <small class="text-danger"><?= $_SESSION['partner_name_error'] ?></small>
                        <?php
                            unset($_SESSION['partner_name_error']);
                        endif
                        ?>
                    </div>
            </div>
            <div class="form-layout-footer ml-3 mt-3">
                <button type="submit" name="submit_partners" class="btn btn-info mg-r-5">Submit</button>
            </div>
            </form>
        </div>
    </div>
    <div class="sl-pagebody" id="partnerList">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-partner_name">Partners list</h6>

            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("partners", "*", "where profile_id='$profile_id'"));
                if ($row < 1) {
                    echo "<h6 class='text-danger text-center'>* No partners added yet *</h6>";
                } else {
                ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">partner_name</th>
                                <th width="10%" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("partners", "*", "where profile_id='$profile_id' ORDER BY id DESC") as $partners) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td><?= $partners['partner_name'] ?></td>
                                    <td scope="col">
                                        <span class="badge  <?= ($partners['status'] == 1) ? 'badge-primary' : 'badge-warning' ?> "><?= ($partners['status'] == 1) ? 'Active' : 'Deactive' ?> </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.inc.php";
?>