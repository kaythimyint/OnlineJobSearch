<?php
require "./header.php";

$sql = "SELECT job_post.*,categories.name AS category_name,job_title.name AS title_name,job_type.name AS jobtype_name
        FROM `job_post`
        LEFT JOIN `categories` ON categories.id = job_post.category_id
        LEFT JOIN `job_title` ON job_title.id = job_post.job_title_id
        LEFT JOIN `job_type` ON job_type.id = job_post.job_type_id
        WHERE job_post.company_id = $id";

$select_res = $mysqli->query($sql);

?>
<div class="content-body">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <input type="hidden" name="form_sub" value="1">
                <a href="./job_post1.php" class="btn btn-primary py-3 px-4 text-white fw-bold" style="font-size:15pt;">Job Create</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th class="col-1">ID No</th>
                                    <th class="col-2">Category</th>
                                    <th class="col-3">Title</th>
                                    <th class="col-2">Job_type</th>
                                    <th class="col-1">Vacancy</th>
                                    <th class="col-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($select_res->num_rows>0) {
                                    while($result = $select_res->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?= $result['company_id'] ?></td>
                                            <td><?= $result['category_name'] ?></td>
                                            <td><?= $result['title_name'] ?></td>
                                            <td><?= $result['jobtype_name'] ?></td>
                                            <td><?= $result['vacancy'] ?></td>
                                            <td>
                                                <a href="<?= $company_base_url . 'job_post_update.php?update_id=' . $result['id'] ?>" class="btn btn-info mb-2">Update</a>
                                                <a href="<?= $company_base_url . 'job_post_detail.php?detail_id=' . $result['id'] ?>" class="btn btn-primary mb-2">Details</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }else{ ?>
                                    <tr colspan="6">
                                        <td>No data</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "./footer.php";
?>


        