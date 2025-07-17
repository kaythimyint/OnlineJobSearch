<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$select_city = selectData('Location_city',$mysqli);
$select_category = selectData('categories',$mysqli);
$select_job_type = selectData('job_type',$mysqli);
$select_salary = selectData('salary',$mysqli);
$sql = "SELECT job_post.* ,job_title.name AS title_name,companies.company_name AS company_name,
        categories.name AS category_name,salary.type AS salary_range,
        location_city.name AS city_name,location_township.name AS township_name
        FROM `job_post`
        LEFT JOIN `job_title` ON job_post.job_title_id=job_title.id
        LEFT JOIN `companies` ON job_post.company_id=companies.id
        LEFT JOIN `categories` ON job_post.category_id=categories.id
        LEFT JOIN `salary` ON job_post.salary_id=salary.id
        LEFT JOIN `location_city` ON job_post.location_city_id=location_city.id
        LEFT JOIN `location_township` ON job_post.location_township_id=location_township.id
        ";
$job_display = $mysqli->query($sql);
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
<section class="top_image" style="background-color: darkblue;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="./img/jobsimage.jpg" alt="" style="height: 270px;width:100%">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select name="" id="" class="form-control border-0 py-2">
                    <option value="">Select City</option>
                    <?php
                    if ($select_city->num_rows>0) {
                        while($data = $select_city->fetch_assoc()){ ?>
                            <option value=""><?= $data['name'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <input type="text" name="" id="" class="form-control py-2" placeholder="Search here">
            </div>
            <div class="col-12 col-md-12 col-lg-3 mb-2">
                <button type="submit" class="form-control" style="background-color: gold;border:none;color:white;font-size:16pt">Search</button>
            </div>
        </div>
    </div>
</section>
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 shadow">
                <ul class="list-group ps-2">
                    <li class="list-group-item border-0">
                        <div class="d-flex justify-content-between">
                            <h4>Category</h4>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </li>
                    <?php
                    if ($select_category->num_rows>0) {
                        while($data = $select_category->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="">
                            <li class="list-group-item border-0"><?= $data['name'] ?></li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </ul>
                <div class="border-1"></div>
                <ul class="list-group ps-2">
                    <li class="list-group-item border-0">
                        <div class="d-flex justify-content-between">
                            <h4>Job Type</h4>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </li>
                    <?php
                    if ($select_job_type->num_rows>0) {
                        while($data = $select_job_type->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="">
                            <li class="list-group-item border-0"><?= $data['name'] ?></li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </ul>
                <div class="border-1"></div>
                <ul class="list-group ps-2">
                    <li class="list-group-item border-0">
                        <div class="d-flex justify-content-between">
                            <h4>Job Type</h4>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </li>
                    <?php
                    if ($select_salary->num_rows>0) {
                        while($data = $select_salary->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="">
                            <li class="list-group-item border-0"><?= $data['type'] ?></li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        <div class="col-lg-8">
            <?php
            if ($job_display->num_rows>0) {
                while($data = $job_display->fetch_assoc()){ ?>
                    <div class="card">
                        <div class="card-body">
                            <h5><?= $data['title_name'] ?></h5>
                            <span><?= $data['company_name'] ?></span><span><?= $data['city_name'].','?></span><span><?= $data['township_name'] ?></span>
                            <p><?= $data['description'] ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
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