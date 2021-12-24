<?php
$blog = "";
require_once('top.inc.php');
?>
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <span class="breadcrumb-item active">Blog</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="card-body-title">Blog List</h6>
                    <p class="mg-b-20 mg-sm-b-30">Here is the list of blogs that you are added.</p>
                </div>
                <div class="mr-5">
                    <a href="manage_blog.php">
                        <button class="btn btn-primary mg-b-10"><i class="fa fa-plus mg-r-10"></i>Add Blog</button>
                    </a>
                </div>
            </div>
            <div class="form-layout">
                <?php
                $row = mysqli_num_rows(select_all("blogs", "*"));
                if ($row < 1) {
                    echo "<h4 class='text-danger text-center'>* No blog added yet *</h4>";
                } else {
                ?>
                    <table id="myTable" class="table  table-responsive table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">blog Description</th>
                                <th scope="col">blog Photo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach (select_all("blogs", "*") as $blog) :
                            ?>
                                <tr>
                                    <th scope="row"><?= ++$i ?></th>
                                    <td><?= $blog['title'] ?></td>
                                    <td><?= mb_substr($blog['blog_description'], 0, 60) . "....." ?></td>
                                    <td><img src="../media/blog/<?= $blog['blog_photo'] ?>" alt="<?= $blog['title'] ?>" width="50"> </td>
                                    <td class="text-center">
                                        <span class="badge badge-<?= ($blog['status'] == 1) ? 'info' : 'warning' ?>"><?= ($blog['status'] == 1) ? 'Active' : 'Deactive' ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="submit_blog.php?id=<?= $blog['id'] ?>&task=update_status"><?= ($blog['status'] == 1) ? 'Deactive' : 'Active' ?></a>
                                                <a class="dropdown-item" href="manage_blog.php?id=<?= $blog['id'] ?>&task=edit">Edit</a>
                                                <?php if (isAdmin()) { ?>
                                                    <button value="submit_blog.php?id=<?= $blog['id'] ?>&task=delete" class=" dropdown-item delete_row btn btn-link">Delete</button>
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