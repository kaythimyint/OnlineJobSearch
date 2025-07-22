<?php
    
require "./user_header.php";

$select_application = selectData('applications',$mysqli,"WHERE user_id = '$id'","COUNT(*) as total_application");

?>
        <div class="col-12 col-lg-8 col-md-12">
            <div class="row my-3">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card shadow movecard" style="border-radius:20px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <?php
                                if ($select_application->num_rows>0) {
                                    $application = $select_application->fetch_assoc();?>
                                        <h1><?= $application['total_application'] ?></h1>
                                <?php
                                    }else{ ?>
                                        <h1>0</h1>
                                <?php
                                    }
                                ?>
                                <p>Total Jobs Apply</p>
                            </div>
                            <div class="text-center">
                                <i class="fa-regular fa-file fs-2 text-warning"></i>
                                <a href="<?= $user_base_url.'user_application.php' ?>" class="btn btn-warning d-block mt-1 text-light fw-bold"><small>View All</small></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="row mb-3">
                <div class="col-12">
                    <div class="container pt-2 shadow-lg  rounded-3" style="height:140px">
                        <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                            <img src="../img/company_profile1.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile2.png" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile3.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile4.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile5.png" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile6.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile7.png" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile8.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                            <div class="swiper-slide">
                            <img src="../img/company_profile9.jpg" alt="" style="width:120px; height:120px;margin:auto;">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="d-flex justify-content-center gap-3 pt-4 mb-4">
                    <h2>Urgent Hiring Jobs</h2>
                    <i class="fas fa-fire" style="color: orange;height:fit-content;font-size:28pt"></i>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow movecard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow movecard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow movecard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between gap-4">
                            <img src="../img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
                            <div>
                                <h5>Job Title(Developer)</h5>
                                <a href="">Company Name Myanmar job search</a>
                                <p>3 hours ago</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
<?php
require "./user_footer.php";
?>