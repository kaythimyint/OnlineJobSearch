<?php
date_default_timezone_set('Asia/Yangon');

require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$sql = "SELECT job_post.*,COUNT(*) as total_jobs,companies.company_name AS company_name,companies.profile AS company_profile,
                    location_city.name AS city_name,location_township.name AS township_name
                    FROM `job_post`
                    LEFT JOIN `companies` ON companies.id=job_post.company_id
                    LEFT JOIN `location_city` ON location_city.id=job_post.location_city_id
                    LEFT JOIN `location_township` ON location_township.id=job_post.location_township_id
                    GROUP BY company_name
                    ";

$select_company = $mysqli->query($sql);

$todayDate = date('Y-m-d H:i:s');
// var_dump($todayDate);
// die();

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
                </ul>
            </div>
        </div>
    </nav>

    <section class="companies mt-5">
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
                                <h5><?= $company['company_name'] ?></h5>
                                <p href=""><?= $company['city_name'].' '.$company['township_name'] ?></p>
                                <p><?= $company['total_jobs'] ?> jobs opening</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                <?php
                }
                }
                ?>
                
            </div>
        </div>
    </section>

    <footer class="pt-5" style="background-color: darkblue;position:fixed;bottom:0;width:100%">
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

    <script src="./bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
  
</body>

</html>