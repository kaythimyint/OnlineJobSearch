<?php
session_start();
date_default_timezone_set('Asia/Yangon');

require "./common/database.php";
require "./common/common_funtion.php";
require "./common/url.php";

$sql = "SELECT job_post.*,companies.company_name AS company_name,companies.profile AS company_profile,job_title.name AS title_name
                    FROM `job_post`
                    LEFT JOIN `companies` ON companies.id=job_post.company_id
                    LEFT JOIN `job_title` ON job_post.job_title_id=job_title.id
                    ";
$select_company = $mysqli->query($sql);

$todayDate = date('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Search</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css">
  <link rel="stylesheet" href="./bootstrap-5.3.6-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .swiper {
      width: 100%;
    }

    .swiper-slide {
      height: 100%;
      background: white;
      text-align: center;
    }

    .swiper-slide:nth-child(2) {
      background: white;
    }

    .swiper-slide:nth-child(3) {
      background: white;
    }

    .swiper-slide:nth-child(4) {
      background: white;
    }

    .swiper-slide:nth-child(5) {
      background: white;
    }

    .swiper-slide:nth-child(6) {
      background: white;
    }

    .swiper-slide:nth-child(7) {
      background: white;
    }

    .swiper-slide:nth-child(8) {
      background: white;
    }

    .swiper-slide:nth-child(9) {
      background: white;
    }

    h2 {
      font-family: "Oswald", sans-serif;
    }

    a {
      text-decoration: none;
      color: gold;
    }

    @media (max-width: 768px) {
      #home h1 {
        font-size: 2rem;
      }
    }

    .header_img {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark" style="background-color:darkblue">
    <div class="container-fluid">
        <a class="navbar-brand ms-5 text-black" href="#">
            <img src="./img/logo.jpg" alt="" style="width:60px;height:60px;border-radius:50%;">
        </a>
        <button class="navbar-toggler me-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end me-5" id="collapsibleNavbar">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mb-1">
                    <a class="nav-link text-light me-3" href="<?= $base_url.'index.php'?>">Home</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light me-3" href="<?= $base_url.'jobs.php' ?>">Jobs</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light me-3" href="<?= $base_url.'companies.php' ?>">Companies</a>
                </li>
                <?php
                if (empty($_SESSION['role']) || $_SESSION['role'] == 'employer') { ?>
                  
                  <li class="nav-item me-3 mb-1">
                      <a class="nav-link text-light px-4 py-2 rounded" href="<?= $base_url . "user_login.php" ?>" style="background-color:gold;">
                          <i class="fa-regular fa-user me-2"></i>User Login
                      </a>
                  </li>
                  <li class="nav-item mb-1">
                      <a class="nav-link text-light px-4 py-2 rounded" href="<?= $base_url . 'company_login.php' ?>" style="background-color:gold;">
                          <i class="fa-regular fa-user me-2"></i>Companies Login
                      </a>
                  </li>
                <?php
                }else{ 
                  if ($_SESSION['role']=='admin') { ?>
                    <li class="nav-item">
                      <a class="nav-link  text-light px-4 py-3 rounded" href="<?= $admin_base_url.'index.php' ?>" style="background-color:gold;">Dashboard</a>
                    </li>
                  <?php
                  }else if($_SESSION['role']=='user'){ ?>
                    <li class="nav-item">
                      <a class="nav-link  text-light px-4 py-3 rounded" href="<?= $user_base_url.'index.php' ?>" style="background-color:gold;">Dashboard</a>
                    </li>
                  <?php
                  }?>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
  <!-- <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:darkblue">
    <div class="container-fluid d-flex justify-content-between">
      <a class="navbar-brand ms-5 text-black" href="#"><img src="./img/logo.jpg" alt="" style="width:60px;height:60px;border-radius:50%;"></a>
      <div class="me-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#job">Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#company">Companies</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link  text-light px-4 py-3 rounded" href="<?= $base_url . "user_login.php" ?>" style="background-color:gold;">
                <i class="fa-regular fa-user" style="margin-right: 10px;"></i>User Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  text-light px-4 py-3 rounded" href="<?= $base_url . 'company_login.php' ?>" style="background-color:gold;">
                <i class="fa-regular fa-user" style="margin-right: 10px;"></i>Companies Login</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav> -->

  <section id="home">
    <section id="home" class="header_img d-flex align-items-center" style="height:80vh; background-image: url('./img/company2.jpg'); background-size: cover; background-position: center; position: relative;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 text-center text-light">
            <h1 class="fw-bold display-5">Start Your Dream Job Here!</h1>
          </div>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-xl-8 col-lg-10">
            <form action="" class="bg-white p-3 rounded shadow">
              <div class="row g-2">
                <div class="col-md-5 col-12">
                  <div class="d-flex align-items-center border-bottom border-secondary pb-1">
                    <select name="city_name" class="form-control border-0">
                      <option value="">Select City</option>
                      <option value="yangon">Yangon</option>
                      <option value="mandalay">Mandalay</option>
                    </select>
                    <i class="fa-solid fa-location-dot ms-2 text-muted"></i>
                  </div>
                </div>
                <div class="col-md-5 col-12">
                  <div class="d-flex align-items-center border-bottom border-secondary pb-1">
                    <input type="text" placeholder="Search here" class="form-control border-0">
                    <i class="fa-solid fa-magnifying-glass ms-2 text-muted"></i>
                  </div>
                </div>
                <div class="col-md-2 col-12">
                  <button type="submit" class="btn w-100 text-dark" style="background-color: gold;">Find Job</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="logo">
      <div class="container pt-2 shadow-lg  rounded-3" style="height:140px">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="./img/company_profile1.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile2.png" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile3.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile4.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile5.png" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile6.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile7.png" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile8.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
            <div class="swiper-slide">
              <img src="./img/company_profile9.jpg" alt="" style="width:120px; height:120px;margin:auto;">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="hiring_jobs mt-5">
      <div class="d-flex justify-content-center gap-3 pt-4 mb-4">
        <h2>Urgent Hiring Jobs</h2>
        <i class="fas fa-fire" style="color: orange;height:fit-content;font-size:28pt"></i>
      </div>
      <div class="container">
        <div class="row">
          <?php
          if ($select_company->num_rows>0) {
            while($company = $select_company->fetch_assoc()){ ?>
              <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-3 shadow">
                  <div class="card-body">
                    <div class="d-flex justify-content-center gap-4">
                      <img src="<?= $base_url.'upload/'.$company['company_profile'] ?>" alt="" style="width:60px;height:60px;">
                      <div>
                        <h5><?= $company['title_name'] ?></h5>
                        <a href=""><?= $company['company_name'] ?></a>
                        <?php
                        $created_at = $company['created_at']; // e.g., "2025-07-15 13:21:19"

                        $today = new DateTime($todayDate);
                        $created = new DateTime($created_at);

                        $interval = $created->diff($today);

                        // echo $interval->format('%H hours %i minutes %s seconds ago');
                        // echo $interval->format('%H hours ago');
                        // die();
                        // $post_time = $company['created_at'] - $todayDate ;
                        // var_dump($todayDate);
                        // var_dump($company['created_at']);
                        // var_dump($post_time);
                        // die();

                        // $dateTime = new DateTime($post_time);
                        // $dateOnly = $dateTime->format('Y-m-d');
                        ?>
                        <p class="mt-1"><?= $interval->format('%h hours ago') ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile2.png" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile3.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile4.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile5.png" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile6.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile7.png" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile8.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile9.jpg" alt="" style="width:60px;height:60px;">
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
    </section>

    <section class="latest_jobs">
      <div class="d-flex justify-content-center gap-3 pt-4 mb-4">
        <h2>Latest Jobs</h2>
        <i class="fas fa-fire" style="color: orange;height:fit-content;font-size:28pt"></i>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile9.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile9.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile9.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile3.jpg" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile2.png" alt="" style="width:60px;height:60px;">
                  <div>
                    <h5>Job Title(Developer)</h5>
                    <a href="">Company Name Myanmar job search</a>
                    <p>3 hours ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card mb-3 shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between gap-4">
                  <img src="./img/company_profile1.jpg" alt="" style="width:60px;height:60px;">
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
    </section>

    <section class="our_partners">
      <div class="d-flex justify-content-center gap-3 pt-4 mb-4">
        <h2>Our Partners</h2>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-3">
            <img src="./img/company_profile1.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-3">
            <img src="./img/company_profile2.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-3">
            <img src="./img/company_profile3.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile4.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile5.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile6.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile6.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile5.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile2.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile7.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile9.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile8.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile2.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile7.png" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile9.jpg" alt="" style="width: 50px;height:50px">
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb-5">
            <img src="./img/company_profile8.jpg" alt="" style="width: 50px;height:50px">
          </div>
        </div>
      </div>
    </section>

    <footer class="pt-5" style="background-color: darkblue;">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-8 order-lg-1 order-1">
            <div>
              <img src="./img/logo.jpg" alt="" style="width: 100px;height: 100px;border-radius:50%;margin-bottom:25px">
              <p class="text-light fs-5">The intermediate plaform between Job Seekers and Companies</p>
            </div>
          </div>
          <div class="col-lg-2 col-4 order-lg-2 order-3 text-light ">
            <h3>Short Links</h3>
            <div style="width: 60px;border:2px solid gold"></div>
            <div style="width: 140px;border:1px solid blue;margin-bottom:20px"></div>
            <p class="fs-5">Jobs</p>
            <p class="fs-5">Companies</p>
            <p class="fs-5">About</p>
          </div>
          <div class="col-lg-2 col-4 order-lg-3 order-4 text-light">
            <h3>Information</h3>
            <div style="width: 60px;border:2px solid gold"></div>
            <div style="width: 140px;border:1px solid blue;margin-bottom:20px"></div>
            <p class="fs-5">Support</p>
            <p class="fs-5">login</p>
            <p class="fs-5">Join With Us</p>
          </div>
          <div class="col-lg-2 col-4 order-lg-4 order-5 text-light">
            <h3>Support</h3>
            <div style="width: 60px;border:2px solid gold"></div>
            <div style="width: 140px;border:1px solid blue;margin-bottom:20px"></div>
            <p class="fs-5">Terms of Service</p>
            <p class="fs-5">Privacy Policy</p>
          </div>
          <div class="col-lg-2 col-4 order-lg-5 order-2 mb-5">
            <div class="text-light fs-5 mb-3">
              <h3 style="color: gold;">436</h3>
              <p>Active Jobs</p>
              <div style="width: 120px;border:1px solid blue"></div>
            </div>
            <div class="text-light fs-5 mb-3">
              <h3 style="color: gold;">1,100+</h3>
              <p>Companies</p>
              <div style="width: 120px;border:1px solid blue"></div>
            </div>
            <div class="text-light fs-5">
              <h3 style="color: gold;">13,500+</h3>
              <p>Candidates</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </section>

  <script src="./bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 6,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        100: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        250: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        576: {
          slidesPerView: 3,
          spaceBetween: 40,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 60,
        },
        992: {
          slidesPerView: 5,
          spaceBetween: 80,
        },
      },
      autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },
    });
  </script>
</body>

</html>