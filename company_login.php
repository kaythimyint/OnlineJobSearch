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
        $result = selectData('companies',$mysqli,"WHERE email='$email'");
        if ($result->num_rows >0) {
            $data = $result->fetch_assoc();
            // var_dump($data);
            // die();
            if ($data['password'] == $byscript_password) {
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['role'] = $data['role'];
                $_SESSION['id'] = $data['id'];
                // var_dump($_SESSION['id']);
                //     die();
                if ($data['role'] == 'employer') {
                    $url = $company_base_url."index.php?success=Login Success";
                    
                    header("Location:$url");
                }else{
                    $url = $base_url.'index.php?error=Role error';
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
    </style>
</head>

<body>
    <section>
        <div class="row flex-column-reverse flex-lg-row m-0">
            <div class="col-12 col-lg-5 d-flex justify-content-center align-items-start align-items-lg-center min-vh-lg-100"
                style="background-color: darkblue;padding-top: 20px;">
                <form action="" style="width:80%;margin:auto;padding-top:20px"  method="POST">
                    <div class="form-group mb-3">
                        <label for="email" class="text-light fw-bold mb-2">Email</label>
                        <div class="d-flex border border-info rounded">
                            <i class="fa-regular fa-user" style="font-size:20pt;color:white;background-color: blue;padding:8px;margin:5px;border-radius:7px"></i>
                            <input type="email" class="form-control" name="email" value="<?= $email ?>" style="background-color: inherit;border:none;color:white;" id="email" placeholder="User Email">
                        </div>
                        <small id="emailHelp" class="form-text text-danger"><?= $email_error ?></small>
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
                    <button type="submit" style="background-color:gold" class="btn btn-lg w-100 text-light">Login</button>
                    <div class="d-flex justify-content-center mt-5">
                        <h5 class="text-light">New to Join? </h5>
                        <a href="<?php echo $base_url . "company_register.php" ?>" style="color: gold;text-decoration:none"> Create an account</a>
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

</html>