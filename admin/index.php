<?php

require "../admin/admin_header.php";
require "../admin/admin_sidebar.php";


$companyCount = selectData('companies',$mysqli);
$job_post_count = selectData('job_post',$mysqli);
$user_count = selectData('users',$mysqli);

$sql = "SELECT company_name, COUNT(*) as total_jobs 
FROM `job_post` 
JOIN `companies` ON job_post.company_id = companies.id 
GROUP BY company_name";
$company_job_post = $mysqli->query($sql);
?>
        <div class="col-12 col-md-12 col-lg-8 mb-3">
           <div class="row my-3">
                <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                    <div class="card shadow movecard mb-2" style="border-radius:20px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <h1><?= $companyCount->num_rows ?></h1>
                                <p>Companies</p>
                            </div>
                            <div class="text-center">
                                
                                <i class="fa-regular fa-file fs-2 text-warning"></i>
                                <a href="" class="btn btn-warning d-block mt-1 text-light fw-bold"><small>View All</small></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                    <div class="card shadow movecard mb-2" style="border-radius:20px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <h1><?= $job_post_count->num_rows ?></h1>
                                <p>Job Post</p>
                            </div>
                            <div class="text-center">
                                <i class="fa-regular fa-file fs-2 text-warning"></i>
                                <a href="" class="btn btn-warning d-block mt-1 text-light fw-bold"><small>View All</small></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                    <div class="card shadow movecard mb-2" style="border-radius:20px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <h1><?= $user_count->num_rows ?></h1>
                                <p>Users</p>
                            </div>
                            <div class="text-center">
                                <i class="fa-regular fa-file fs-2 text-warning"></i>
                                <a href="" class="btn btn-warning d-block mt-1 text-light fw-bold"><small>View All</small></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-3">Companies List</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-2">No</td>
                                <td class="col-6">Company Names</td>
                                <td class="col-4">Job Post</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($company_job_post->num_rows > 0) {
                                $count = 0;

                                while($data = $company_job_post->fetch_assoc()) {
                                    $count += 1;
                                    ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $data['company_name'] ?></td>
                                        <td><?= $data['total_jobs'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../admin/admin_footer.php";
?>