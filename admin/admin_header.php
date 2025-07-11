<?php
require "../common/check_auth.php";
require "../common/common_funtion.php";
require "../common/database.php";
require "../common/url.php";

if ($_SESSION['role'] == 'user') {
  $url = $base_url . "index.php?error=Role error";
  header("Location:$url");
  exit();
}else if ($_SESSION['role'] == 'employer') {
  $url = $base_url . "index.php?error=Role error";
  header("Location:$url");
  exit();
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
  <script src="../js/jquery.min.js"></script>
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
              <a class="nav-link text-light me-3" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#job">Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light me-3" href="#company">Companies</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  text-light px-4 py-3 rounded" href="<?php $user_base_url . 'index.php' ?>" style="background-color:gold;">Dashboard</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>