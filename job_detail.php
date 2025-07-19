<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT job_post.*, job_title.name AS title_name, companies.company_name AS company_name,
        categories.name AS category_name, salary.type AS salary_range,job_type.name AS jobtype_name,
        location_city.name AS city_name, location_township.name AS township_name
        FROM job_post
        LEFT JOIN job_title ON job_post.job_title_id=job_title.id
        LEFT JOIN companies ON job_post.company_id=companies.id
        LEFT JOIN categories ON job_post.category_id=categories.id
        LEFT JOIN salary ON job_post.salary_id=salary.id
        LEFT JOIN job_type ON job_post.job_type_id=job_type.id
        LEFT JOIN location_city ON job_post.location_city_id=location_city.id
        LEFT JOIN location_township ON job_post.location_township_id=location_township.id
        WHERE job_post.id = '$id'";

    $job_post = $mysqli->query($sql);
    if ($job_post->num_rows>0) {
        $post = $job_post->fetch_assoc();
    }
}else{
    echo "<script>window.location.href='jobs.php?error=idnotfound';</script>";
    exit();
}

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
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: calibri;
    }

    h2 ,h4{
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
    span,h5
    {
        font-family:"Share Tech", sans-serif;
        font-weight: 800;
        font-style: normal;
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
                    <a class="nav-link text-light me-3" href="<?= $base_url.'jobs.php'?>">Jobs</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light me-3" href="#company">Companies</a>
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
<section class="top_image">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="./img/jobsimage.jpg" alt="" style="height: 180px;width:100%">
            </div>
        </div>
    </div>
</section>
<section id="detail_job">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-12">
                <div class="border my-2 px-4">
                    <div class="mt-3">
                        <h2><?= $post['title_name'] ?></h2>
                        <p class="text-warning"><?= $post['company_name'] ?></p>
                        <p><?= $post['jobtype_name'] ?> | Job ID : <?= $post['id'] ?></p>
                        <div class="border w-100"></div>
                    </div>
                    <div class="mt-3">
                        <h2>Description</h2>
                        <p><?= $post['description'] ?></p>
                        <div class="border w-100"></div>
                    </div>
                    <div class="mt-3">
                        <h2>Requirement</h2>
                        <p><?= $post['requirements'] ?></p>
                        <div class="border w-100"></div>
                    </div>
                    <div class="mt-3">
                        <h2>Benefit</h2>
                        <p><?= $post['benefit'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="my-2">
                    <div class="card ">
                        <h2 style="background-color: darkblue;color:white;padding:10px">Job Summary</h2>
                        <div class="card-body">
                             
                        </div>
                    </div>
                </div>
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

</body>

</html>