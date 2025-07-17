<?php

    $id = $_SESSION['id'];
    $result = selectData('users',$mysqli,"WHERE id = '$id'");
    if ($result->num_rows >0) {
        $data = $result->fetch_assoc();
    // var_dump($data);
    // die();
}
?>
<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-4 mb-3">
            <div class="card">
                <img class="card-img-top pt-2" src="../img/profile.jpg" alt="Card image" style="width: 95%;height:230px;margin:auto">
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $data['email'] ?></h5>
                    <p class="card-text text-warning text-center"><?= $data['name'] ?></p>
                    <div class="">
                        <div class="">
                            <a href="#" class="btn btn-primary btn-lg w-100">See Profile</a>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url . 'index.php' ?>" class="btn btn-lg" style="font-size:13pt"><i class="fa-solid fa-layer-group me-2"></i> Dashboard</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_title.php" ?>" class="btn btn-lg"><i class="fa-solid fa-list-check me-2"></i>Job Title</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_type.php" ?>" class="btn btn-lg"><i class="fa-solid fa-table-list me-2"></i>Job Type</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_categories.php" ?>" class="btn btn-lg"><i class="fa-solid fa-list me-2"></i>Job Categories</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."industry_type.php" ?>" class="btn btn-lg"><i class="fa-solid fa-industry me-2"></i>Industy Type</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."location_city.php" ?>" class="btn btn-lg"><i class="fa-solid fa-location-dot me-2"></i>Location City</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."location_township.php" ?>" class="btn btn-lg"><i class="fa-solid fa-location-dot me-2"></i>Location Township</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."salary.php" ?>" class="btn btn-lg"><i class="fa-solid fa-money-check-dollar me-2"></i>Salary</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."experience.php" ?>" class="btn btn-lg"><i class="fas fa-landmark me-2"></i>Experince</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $company_base_url."logout.php" ?>" class="btn btn-lg"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>    
                        </div>
                    </div>
                </div>
            </div>
        </div>