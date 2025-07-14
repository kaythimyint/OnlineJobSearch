<?php
session_start();
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

$error = false;
$email =
$email_error =
$password =
$password_error = '';

if (isset($_POST['form_submit']) && $_POST['form_submit']=='1') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);

    if (strlen($email) == 0) {
        $error = true;
        $email_error  = "Email is require";
    }
    if (strlen($password) == 0) {
        $error = true;
        $password_error  = "Password is require";
    }else {
        $error = false;
        $byscript_password = md5($password);
    }

    if (!$error) {
        $result = selectData('users',$mysqli,"WHERE email='$email'");
        if ($result->num_rows >0) {
            $data = $result->fetch_assoc();
            if ($data['password'] == $byscript_password) {
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['role'] = $data['role'];
                $_SESSION['id'] = $data['id'];
                if ($data['role'] == 'admin') {
                    $url = $admin_base_url."index.php?success=Login Success";
                    header("Location:$url");
                }else{
                    $url = $user_base_url."index.php?success=Login Success";
                    header("Location:$url");
                }
            }else{
                $error = true;
                $password_error  = "Password is incorrect.";
            }
        }else{
            $error = true;
            $email_error  = "This email is not register.";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css">
    <script src="./js/jquery.min.js"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100%;
            overflow-x: hidden;
        }

        input[type=email]::placeholder,
        input[type=password]::placeholder {
            color: white;
        }

        section {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-image: url('./img/teamworks.png');
            /* 👈 adjust path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(4px) brightness(0.8);
            z-index: -1;
        }

        section * {
            position: relative;
            z-index: 1;
        }


        @media (min-width: 992px) {
            .min-vh-lg-100 {
                min-height: 100vh !important;
            }
        }

        .profile{
            background-color: gold;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>  
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue;padding-top: 20px;">
                <form action="" style="width:80%;margin:auto;padding-top:20px"  method="POST">
                    <div class="form-group mb-3 d-flex justify-content-between">
                        <img src="./img/profile.jpg" id="preview" style="width: 200px;height:200px;">
                        <div class="pt-5">
                        <label for="profile" class="profile mb-3">Selete Profile Image</label>
                        <input type="file" name="profile" style="display: none;" id="profile">
                        <p class="text-light">Supported files are jpg,jpeg,png</p>
                        <small class="text-danger">Error</small>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="text-light fw-bold mb-2">Password</label>
                        <div class="d-flex border border-info rounded">
                            <i class="fa-solid fa-key" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                            <input type="password" class="form-control" name="password" value="<?= $password ?>" style="background-color: inherit;border:none;color:white;" id="email" placeholder="Enter Password">
                        </div>
                        <small id="emailHelp" class="form-text text-danger"><?= $password_error ?></small>
                    </div>
                    <input type="hidden" name="form_submit" value="1" />
                    <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Register</button>
                    <div class="d-flex justify-content-center mt-5">
                        <h5 class="text-light">Have an account? </h5>
                        <a href="<?php echo $base_url . "company_login.php" ?>" style="color: gold;text-decoration:none">Login now</a>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center min-vh-lg-100 py-5">
                <div class="">
                    <h1 class="text-white pb-3">Welcome To</h1>
                    <img src="./img/logo.jpg" alt="" style="width: 180px;height:180px;border-radius:50%">
                </div>
            </div>
        </div>
    </section>
    <script src="./bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
</body>
<script>
  const fileInput = document.getElementById("profile");
  const preview = document.getElementById("preview");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
      });

      reader.readAsDataURL(file);
    }
  });
</script>
</html>
