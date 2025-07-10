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
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top pt-2" src="../img/profile.jpg" alt="Card image" style="width: 95%;height:230px;margin:auto">
                <div class="card-body">
                    <h4 class="card-title text-center"><?= $data['email'] ?></h4>
                    <p class="card-text text-warning text-center"><?= $data['name'] ?></p>
                    <div class="">
                        <div class="">
                            <a href="#" class="btn btn-primary btn-lg w-100">See Profile</a>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_title.php" ?>" class="btn btn-lg">Job Title</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_type.php" ?>" class="btn btn-lg">Job Type</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."job_categories.php" ?>" class="btn btn-lg">Job Categories</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."location_city.php" ?>" class="btn btn-lg">Location City</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."location_township.php" ?>" class="btn btn-lg">Location Township</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."salary.php" ?>" class="btn btn-lg">Salary</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="<?= $admin_base_url."experience.php" ?>" class="btn btn-lg">Experince</a>
                            <div class="" style="border:1px dotted silver;"></div>
                        </div>
                        <div>
                            <a href="" class="btn btn-lg">Logout</a>    
                        </div>
                    </div>
                </div>
            </div>
        </div>