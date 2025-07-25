<?php
session_start();
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$select_city = selectData('Location_city',$mysqli);
$select_category = selectData('categories',$mysqli);
$select_job_type = selectData('job_type',$mysqli);
$select_salary = selectData('salary',$mysqli);

// if (isset($_GET['city_id']) && $_GET['city_id'] != '') {
//     $city_id = $_GET['city_id'];        
// }
// $city_search_sql = "SELECT job_post.*, job_title.name AS title_name, companies.company_name AS company_name,
//     categories.name AS category_name, salary.type AS salary_range,
//     job_type.name AS job_type_name,
//     location_city.name AS city_name, location_township.name AS township_name
//     FROM job_post
//     LEFT JOIN job_title ON job_post.job_title_id=job_title.id
//     LEFT JOIN companies ON job_post.company_id=companies.id
//     LEFT JOIN categories ON job_post.category_id=categories.id
//     LEFT JOIN salary ON job_post.salary_id=salary.id
//     LEFT JOIN job_type ON job_post.job_type_id=job_type.id
//     LEFT JOIN location_city ON job_post.location_city_id=location_city.id
//     LEFT JOIN location_township ON job_post.location_township_id=location_township.id
//     WHERE job_post.location_city_id = $city_id ";
// $city_search = $mysqli->query($city_search_sql);


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
    .pagination-container .btn {
        min-width: 100px;
        margin-bottom: 10px;
    }
    .click_card
    {
        cursor: pointer;
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
                    <a class="nav-link text-light me-3" href="<?= $base_url.'companies.php' ?>  ">Companies</a>
                </li>
                <?php
                if (empty($_SESSION['role'])|| $_SESSION['role'] == 'employer') { ?>
                  
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
<section class="top_image" style="background-color: darkblue;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="./img/jobsimage.jpg" alt="" style="height: 230px;width:100%">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-md-6 col-lg-3 mb-2">
                <select name="" id="" class="form-control border-0 py-2">
                    <option value="">Select City</option>
                    <?php
                    if ($select_city->num_rows>0) {
                        while($data = $select_city->fetch_assoc()){ ?>
                            <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
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
                        while($category = $select_category->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="" class="category-search-box"  value="<?= $category['name'] ?>">
                            <li class="list-group-item border-0"><?= $category['name'] ?></li>
                            </div>
                    <?php
                        }
                    }
                    $city_id = '';
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
                        while($job_type = $select_job_type->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="" class="jobtype-search-box"  value="<?= $job_type['name'] ?>">
                            <li class="list-group-item border-0"><?= $job_type['name'] ?></li>
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
                            <h4>Salary Range</h4>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </li>
                    <?php
                    if ($select_salary->num_rows>0) {
                        while($salary = $select_salary->fetch_assoc())
                        { ?>
                            <div class="d-flex">
                            <input type="checkbox" name="" id="" class="salary-search-box"  value="<?= $salary['type'] ?>">
                            <li class="list-group-item border-0"><?= $salary['type'] ?></li>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        <div class="col-lg-8 card-show">
            
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-container"></div>
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
<script>
    $(document).ready(function(){

        let allJobs = [];
        let jobsPerPage = 4;
        let currentPage = 1;

        function collectFilters(){
            let categories = [];
            let job_types = [];
            let salaries = [];

            $('.category-search-box:checked').each(function(){
                categories.push($(this).val());
            });

            $('.jobtype-search-box:checked').each(function(){
                job_types.push($(this).val());
            });

            $('.salary-search-box:checked').each(function(){
                salaries.push($(this).val());
            });

            return {
                categories: categories,
                job_types: job_types,
                salaries: salaries
            };
        }

        function clearFilters() {
            $('.category-search-box, .jobtype-search-box, .salary-search-box').prop('checked', false);
        }

        function loadJobs(filters = {}){
            console.log(filters);
            
            $.ajax({
                url: 'jobs_api.php',
                type: 'POST',
                data: filters,
                dataType: 'json',
                success: function(response){
                    if(response.jobs){
                        allJobs = response.jobs;
                        currentPage = 1;
                        renderJobs();
                        renderPagination();
                    } else {
                        $('.card-show').html('<p class="text-center text-danger">No jobs found</p>');
                        $('.pagination-container').html('');
                    }
                    // clearFilters();  // optional
                }
            });
        }

        function renderJobs() {
            let start = (currentPage - 1) * jobsPerPage;
            let end = start + jobsPerPage;
            let paginatedJobs = allJobs.slice(start, end);

            let html = '';
            paginatedJobs.forEach(function(job){
                html += generateJobCard(job);
            });

            $('.card-show').html(html);
        }

        function renderPagination() {
            const totalPages = Math.ceil(allJobs.length / jobsPerPage);
            let html = '';

            if (totalPages <= 1) {
                $('.pagination-container').html('');
                return;
            }

            // Prev button
            if (currentPage > 1) {
                html += `<button class="page-btn btn btn-sm btn-outline-primary me-1" data-page="${currentPage - 1}">&laquo; Prev</button>`;
            }

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                html += `<button class="page-btn btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'} me-1" data-page="${i}">${i}</button>`;
            }

            // Next button
            if (currentPage < totalPages) {
                html += `<button class="page-btn btn btn-sm btn-outline-primary me-1" data-page="${currentPage + 1}">Next &raquo;</button>`;
            }

            $('.pagination-container').html(html);
        }

        function generateJobCard(job){
            return `
                <div class="card mb-2 shadow click_card" data-id="${job.id}">
                    <div class="card-body">
                        <h5>${job.title}</h5>
                        <span class="me-5">${job.company}</span>    
                        <i class="fa-solid fa-location-dot"></i> ${job.city}, ${job.township}
                        <i class="fa-solid fa-id-card ms-2"></i> Job ID : ${job.id}
                        <p class="pt-3">${job.description}</p>
                        <div class="d-flex justify-content-between fw-bold">
                            <p class="pt-2">${job.salary}</p>
                            <p class="pt-2"><i class="fa-solid fa-calendar-days"></i> ${job.deadline}</p>
                        </div>
                    </div>
                </div>`;
        }

        // Pagination button click
        $(document).on('click', '.page-btn', function(){
            currentPage = parseInt($(this).data('page'));
            renderJobs();
            renderPagination();
        });

        // Initial load
        loadJobs();

        // Filter logic with radio-like checkbox
        $('.category-search-box').click(function(){
            $('.category-search-box').not(this).prop('checked', false);
            let filters = collectFilters();
            loadJobs(filters);
        });

        $('.jobtype-search-box').click(function(){
            $('.jobtype-search-box').not(this).prop('checked', false);
            let filters = collectFilters();
            loadJobs(filters);
        });

        $('.salary-search-box').click(function(){
            $('.salary-search-box').not(this).prop('checked', false);
            let filters = collectFilters();
            loadJobs(filters);
        });

        // Job card click
        $(document).on('click', '.click_card', function(){
            const id = parseInt($(this).data('id'));
            if (!Number.isNaN(id) && id > 0) {
                window.location.href = 'job_detail.php?id=' + id;
            }
        });

    });
</script>

</body>

</html>