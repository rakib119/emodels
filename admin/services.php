<?php
$services = "";
require_once('top.inc.php');
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Services</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="card-body-title">Service List</h6>
                    <p class="mg-b-20 mg-sm-b-30">Here is the list of Services that can provided by this company.</p>
                </div>
                <div class="mr-5">
                    <a href="manage_services.php">
                        <button class="btn btn-primary mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add Services</button>
                    </a>
                </div>
            </div>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("services", "*"));
                if ($row < 1) {
                    echo "<h4 class='text-danger text-center'>* No services added yet *</h4>";
                } else {
                ?>
                    <table id="myTable" class="table  table-responsive table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Service Details</th>
                                <th scope="col">Service Photo</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("services", "*") as $services) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td><?= $services['title'] ?></td>
                                    <td><?= mb_substr($services['service_details'], 0, 60) . "....." ?></td>
                                    <td><img src="../media/services/<?= $services['service_photo'] ?>" alt="<?= $services['title'] ?>" width="50"> </td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= ($services['status'] == 1) ? 'info' : 'warning' ?>"><?= ($services['status'] == 1) ? 'Active' : 'Deactive' ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="submit_services.php?id=<?= $services['id'] ?>&task=update_status"><?= ($services['status'] == 1) ? 'Deactive' : 'Active' ?></a>
                                                <a class="dropdown-item" href="manage_services.php?id=<?= $services['id'] ?>&task=edit">Edit</a>
                                                <?php if (isAdmin()) { ?>
                                                    <button value="submit_services.php?id=<?= $services['id'] ?>&task=delete" class=" dropdown-item delete_row btn btn-link">Delete</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['old_company_name']);
    unset($_SESSION['old_designation']);
    unset($_SESSION['old_duration']);
    require_once "footer.inc.php";
    ?>