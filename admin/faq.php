<?php
$faq = "";
require_once('top.inc.php');
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Faq</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="card-body-question">Faq List</h6>
                    <p class="mg-b-20 mg-sm-b-30">Here is the list of Faq that you are added.</p>
                </div>
                <div class="mr-5">
                    <a href="manage_faq.php">
                        <button class="btn btn-primary mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add Faq</button>
                    </a>
                </div>
            </div>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("faq", "*"));
                if ($row < 1) {
                    echo "<h4 class='text-danger text-center'>* No Faq added yet *</h4>";
                } else {
                ?>
                    <table id="myTable" class="table  table-responsive table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Questions</th>
                                <th scope="col">Answear</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("faq", "*") as $faq) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td><?= $faq['question'] ?></td>
                                    <td><?= mb_substr($faq['answere'], 0, 60) . "....." ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= ($faq['status'] == 1) ? 'info' : 'warning' ?>"><?= ($faq['status'] == 1) ? 'Active' : 'Deactive' ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="submit_faq.php?id=<?= $faq['id'] ?>&task=update_status"><?= ($faq['status'] == 1) ? 'Deactive' : 'Active' ?></a>
                                                <a class="dropdown-item" href="manage_faq.php?id=<?= $faq['id'] ?>&task=edit">Edit</a>
                                                <?php if (isAdmin()) { ?>
                                                    <button value="submit_faq.php?id=<?= $faq['id'] ?>&task=delete" class=" dropdown-item delete_row btn btn-link">Delete</button>
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
    require_once "footer.inc.php";
    ?>