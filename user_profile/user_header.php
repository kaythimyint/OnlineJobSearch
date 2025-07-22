<?php

require "../common/check_auth.php";
require "../common/database.php";
require "../common/common_funtion.php";

if ($_SESSION['role'] != 'user') {
  $url = $base_url . "index.php?error=Role error";
  header("Location:$url");
  exit();
}

$id = $_SESSION['id'];
$result = selectData('users',$mysqli,"WHERE id = '$id'");
if ($result->num_rows >0) {
    $data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Search</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css">
  <link rel="stylesheet" href="../bootstrap-5.3.6-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="../js/jquery.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: calibri;
    }

    h2 {
      font-family: "Oswald", sans-serif;
    }

    a {
      text-decoration: none;
      color: gold;
    }

    .btn:hover{
      color: gold;
    }

    .btn:focus,
    .btn:active{
      border:none;
      outline: none;
    }

    .movecard:hover{
      transform: translateY(-5px);
    }

    .profile{
      background-color: gold;
      padding: 10px;
      color: white;
      font-weight: bold;
    }

    .user_inputbox:focus{
      outline: none;
      box-shadow: none;
      border: none;
    }

    .user_input {
      border: 1px solid #ccc;
      border-radius: 7px;
      transition: border-color 0.3s ease;
    }

    .user_input:focus-within{
      border-color: gold;
    }
  </style>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:darkblue">
    <div class="container-fluid d-flex justify-content-between">
      <a class="navbar-brand ms-5 text-black" href="#"><img src="../img/logo.jpg" alt="" style="width:60px;height:60px;border-radius:50%;"></a>
      <div class="me-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="<?= $base_url.'index.php'?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="<?= $base_url.'jobs.php'?>">Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#company">Companies</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  text-light px-4 py-3 rounded" href="<?= $user_base_url."index.php" ?>" style="background-color:gold;">Dashboard</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container pt-5">
    <div class="row">
      <div class="col-12 col-lg-4 col-md-7 col-sm-10 mb-3">
        <div class="card shadow movecard">
            <?php
                if ($data['profile'] == '') { ?>
                  <img class="card-img-top pt-2" src="../img/profile.jpg" alt="Card image" style="width: 95%;height:230px;margin:auto">
            <?php
                }
                else{ ?>
                  <img class="card-img-top pt-2" src="<?= $user_base_url.'profile/'.$data['profile'] ?>" alt="Card image" style="width: 95%;height:230px;margin:auto">
            <?php
                }
            ?>
            
            <div class="card-body">
                <h4 class="card-title text-center"><?= $data['email'] ?></h4>
                <p class="card-text text-warning text-center"><?= $data['name'] ?></p>
                <div class="">
                    <div class="">
                        <a href="#" class="btn btn-primary btn-lg w-100">See Profile</a>
                    </div>
                    <div>
                        <a href="<?= $user_base_url . 'index.php' ?>" class="btn btn-lg" style="font-size:13pt"><i class="fa-solid fa-layer-group me-2"></i> Dashboard</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $user_base_url."user_profile_update.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fas fa-edit me-2"></i> Profile Update</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $user_base_url."user_education.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fas fa-book-open me-2"></i> Education</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $user_base_url."user_skill.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fas fa-landmark me-2"></i> Skill</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $user_base_url."user_resume.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fas fa-file me-2"></i> View Resume</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $admin_base_url."salary.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fa-solid fa-unlock-keyhole me-2"></i> Change Password</a>
                        <div class="" style="border:1px dotted silver;"></div>
                    </div>
                    <div>
                        <a href="<?= $user_base_url."user_logout.php" ?>" class="btn btn-lg" style="font-size:13pt"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>    
                    </div>
                </div>
            </div>
        </div>
    </div>